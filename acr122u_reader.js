import { createRequire } from 'module';
const require = createRequire(import.meta.url);

const { NFC } = require('nfc-pcsc');


// Function to convert JSON to a byte array (Buffer)
function jsonToRawData(jsonData) {
    try {
        const jsonString = JSON.stringify(jsonData); 
        return Buffer.from(jsonString, 'utf8'); 
    } catch (error) {
        console.error('Error converting JSON to raw data:', error.message);
        return null;
    }
}

// Function to write data across all writable blocks of the card
async function writeDataToAllBlocks(reader, rawData) {
    try {
        const keyType = 0x60; 
        const key = Buffer.from([0xff, 0xff, 0xff, 0xff, 0xff, 0xff]); 
        const blockSize = 16; 
        const totalSectors = 40; 

        let offset = 0;

        for (let sector = 2; sector < totalSectors; sector++) {
            
            const blocksPerSector = sector < 32 ? 4 : 16; 
            const sectorStartBlock = sector < 32 ? sector * 4 : 128 + (sector - 32) * 16; 
            const maxBlock = sectorStartBlock + blocksPerSector - 1; 

            for (let block = sectorStartBlock; block < maxBlock; block++) {
                if (offset >= rawData.length) {
                    console.log('All data written successfully!');
                    // return;
                    process.exit(0);
                }

                // Slice the next chunk of data
                let chunk = rawData.slice(offset, offset + blockSize);
                offset += blockSize;

                if (chunk.length < blockSize) {
                    // Pad the chunk to make it 16 bytes
                    const padding = Buffer.alloc(blockSize - chunk.length, 0x00);
                    chunk = Buffer.concat([chunk, padding]);
                }

                try {
                    
                    await reader.authenticate(block, keyType, key); 
                    await reader.write(block, chunk, blockSize); 
                   
                } catch (error) {
                    console.error(`Error writing to block ${block}:`, error.message);
                }
            }
        }

        console.log('Data written to all writable blocks.');
    } catch (error) {
        console.error('Error writing to the card:', error.message);
    }
}


// Function to check if a block is empty
function isBlockEmpty(blockData) {
    return blockData.equals(Buffer.alloc(16, 0x00)); 
}

// Function to read all writable blocks and check if card is empty
async function isCardEmpty(reader) {
    const keyType = 0x60; 
    const key = Buffer.from([0xff, 0xff, 0xff, 0xff, 0xff, 0xff]); 
    const totalSectors = 40; 

    for (let sector = 2; sector < totalSectors; sector++) {
        
        const blocksPerSector = sector < 32 ? 4 : 16; 
        const sectorStartBlock = sector < 32 ? sector * 4 : 128 + (sector - 32) * 16; 
        const maxBlock = sectorStartBlock + blocksPerSector - 1; 

        for (let block = sectorStartBlock; block < maxBlock; block++) {
            try {                
                await reader.authenticate(block, keyType, key); 
                const blockData = await reader.read(block, 16); 
                
                if (!isBlockEmpty(blockData)) {
                    console.log(`Data found in block ${block}.`);
                    return false; 
                }
            } catch (error) {
                console.error(`Error reading block ${block}:`, error.message);
                throw error;
            }
        }

    }

    console.log('Card is empty.');
    return true; 
}

// Function to erase all writable blocks 
async function eraseCard(reader) {
    const keyType = 0x60; 
    const key = Buffer.from([0xff, 0xff, 0xff, 0xff, 0xff, 0xff]); 
    const blockSize = 16; 
    const totalSectors = 40; 

    const emptyBlock = Buffer.alloc(blockSize, 0x00); 
    for (let sector = 2; sector < totalSectors; sector++) {
        

        const blocksPerSector = sector < 32 ? 4 : 16; 
        const sectorStartBlock = sector < 32 ? sector * 4 : 128 + (sector - 32) * 16; 
        const maxBlock = sectorStartBlock + blocksPerSector - 1; 

        for (let block = sectorStartBlock; block < maxBlock; block++) {
            try {
                await reader.authenticate(block, keyType, key); 
                await reader.write(block, emptyBlock, blockSize); 
            } catch (error) {
                console.error(`Error erasing block ${block}:`, error.message);
                throw error;
            }
        }
    }

    console.log('Card erased successfully!');
    return;
}


const nfc = new NFC();

nfc.on('reader', reader => {
    reader.autoProcessing = false;
    reader.on('card', async card => {
        const jsonData= process.argv[2];
        // Example JSON data to write
    //     const jsonData = {
    //         asgn_c: "9878987678",
    // veh_n: "8765432VGF",
    // veh_t: "3",
    // army_n: "8767564530",
    // blk_n: "v7",
    // dvr: "ASHOK KUMAR",
    // rk: "4",
    // str_t: "3",
    // ut: "9",
    // date: "2024-11-21T09:09",
    // products: [
    //     {
    //         p_n: "4",
    //         p_q: "1",
    //         p_acc: [
    //             {
    //                 n: "8",
    //                 q: "1"
    //             },
    //             {
    //                 n: "9",
    //                 q: "1"
    //             }
    //         ]
    //     },
    //     {
    //         p_n: "4",
    //         p_q: "1",
    //         p_acc: [
    //             {
    //                 n: "8",
    //                 q: "1"
    //             },
    //             {
    //                 n: "9",
    //                 q: "1"
    //             }
    //         ]
    //     },
    //     {
    //         p_n: "4",
    //         p_q: "1",
    //         p_acc: [
    //             {
    //                 n: "8",
    //                 q: "1"
    //             },
    //             {
    //                 n: "9",
    //                 q: "1"
    //             }
    //         ]
    //     },
    //     {
    //         p_n: "4",
    //         p_q: "1",
    //         p_acc: [
    //             {
    //                 n: "8",
    //                 q: "1"
    //             },
    //             {
    //                 n: "9",
    //                 q: "1"
    //             }
    //         ]
    //     },
    //     {
    //         p_n: "5",
    //         p_q: "1",
    //         p_acc: [
    //             {
    //                 n: "10",
    //                 q: "12"
    //             },
    //             {
    //                 n: "11",
    //                 q: "8"
    //             },
    //             {
    //                 n: "12",
    //                 q: "2"
    //             }
    //         ]
    //     },
    //     {
    //         p_n: "5",
    //         p_q: "1",
    //         p_acc: [
    //             {
    //                 n: "10",
    //                 q: "12"
    //             },
    //             {
    //                 n: "11",
    //                 q: "8"
    //             },
    //             {
    //                 n: "12",
    //                 q: "2"
    //             }
    //         ]
    //     }
    // ],
    //         timestamp: Date.now()
    //     };
         // Convert JSON to raw data
        const rawData = jsonToRawData(jsonData);
        if (!rawData) {
            console.error('Failed to prepare data for writing.');
            return;
        }

        // Check if the card is empty
        const cardEmpty = await isCardEmpty(reader);

        if (!cardEmpty) {
            await eraseCard(reader);
        } else {
            console.log('Card is empty.');
        }

        // Write the buffer (rawData) to the card
        await writeDataToAllBlocks(reader, rawData);
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
