import { createRequire } from 'module';
const require = createRequire(import.meta.url);

const { NFC } = require('nfc-pcsc');


// Function to read the UID from the card
async function readCardUID(reader) {
    try {
        const keyType = 0x60; 
        const key = Buffer.from([0xff, 0xff, 0xff, 0xff, 0xff, 0xff]); 
        const blockNumber = 0; 
        await reader.authenticate(blockNumber, keyType, key); 
        const blockData = await reader.read(blockNumber, 16, 16); 

        // Extract the UID (typically first 4 or 7 bytes of block 0, depending on card type)
        const uid = blockData.slice(0, 4); 
        return uid.toString('hex');
    } catch (error) {
        console.error('Error reading UID from the card:', error.message);
        return null;
    }
}


// Function to read raw data from all sectors and blocks of a MIFARE card
async function readAllDataFromCard(reader) {
    try {
        const keyType = 0x60; 
        const key = Buffer.from([0xff, 0xff, 0xff, 0xff, 0xff, 0xff]); 
        let rawData = Buffer.alloc(0); 
        const totalSectors = 40; 

        for (let sectorNumber = 2; sectorNumber < totalSectors; sectorNumber++) {
    
            const blocksInSector = sectorNumber < 32 ? 4 : 16;  
            const sectorStartBlock = sectorNumber < 32
                ? sectorNumber * 4
                : 32 * 4 + (sectorNumber - 32) * 16;

            // Iterate over all blocks in the sector
            for (let blockOffset = 0; blockOffset < blocksInSector; blockOffset++) {
                const currentBlock = sectorStartBlock + blockOffset;
                try {
                    await reader.authenticate(currentBlock, keyType, key); 
                    const blockData = await reader.read(currentBlock, 16, 16); 
                    rawData = Buffer.concat([rawData, blockData]); 
                } catch (blockError) {
                    console.error(`Error processing block ${currentBlock}: ${blockError.message}`);
                }
            }
        }

        console.log('All data read successfully!');
        return rawData;
    } catch (error) {
        console.error('Error reading all data from the card:', error.message);
        return null;
    }
}


// convert rawData to Json format
function rawDataToJson(rawData) {
    let jsonString = '';  
    try {
        // Convert raw data buffer to string with UTF-8 encoding
        jsonString = rawData.toString('utf8');

        // Remove unwanted characters
        jsonString = jsonString.replace(/\0/g, ''); 
        jsonString = jsonString.replace(/[^\x20-\x7E]/g, ''); 
        jsonString = jsonString.replace(/i{1,}/g, ''); 
        jsonString = jsonString.trim(); 

        // Validate JSON structure
        if (!jsonString.startsWith('{') && !jsonString.startsWith('[')) {
            throw new Error('Invalid JSON structure: does not start with "{" or "[".');
        }

        // Parse the cleaned string into JSON
        const jsonData = JSON.parse(jsonString);
        return jsonData;
    } catch (error) {
        console.error('Error converting raw data to JSON:', error.message);

        // Log the raw data string for debugging
        console.error('Raw string content after cleaning:', jsonString);

        return null;
    }
}




// NFC instance
const nfc = new NFC();

nfc.on('reader', reader => {
    console.log(`${reader.reader.name} reader attached`);

    reader.autoProcessing = false;

    reader.on('card', async card => {
         const uid = await readCardUID(reader);
        if (!uid) {
            console.error('Failed to read UID from the card.');
            return;
        }

        // Read all data from the card
        const rawData = await readAllDataFromCard(reader);
        if (!rawData) {
            console.error('Failed to read data from the card.');
            process.exit(1); 
        }
        // Convert raw data to JSON
        const jsonData = rawDataToJson(rawData);
        if (!jsonData) {
            console.error('Failed to parse raw data to JSON.');
            process.exit(1); 
        }
        
        const updatedJsonData = { uid, ...jsonData };

        console.log('Parsed JSON data with UID:', updatedJsonData);  
        process.exit(1);   
    });

    reader.on('error', err => {
        console.error(`Reader error: ${err.message}`);
    });

    reader.on('end', () => {
        console.log(`${reader.reader.name} reader disconnected`);
    });
});

nfc.on('error', err => {
    console.error('NFC error:', err.message);
});
