import { createRequire } from 'module';
const require = createRequire(import.meta.url);

const { NFC } = require('nfc-pcsc');

// Helper function to read the UID from the card
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

// NFC instance
const nfc = new NFC();

nfc.on('reader', reader => {
    reader.autoProcessing = false;
    reader.on('card', async card => {
        // Attempt to read the UID from the card
        const uid = await readCardUID(reader);
        if (!uid) {
            console.error('Failed to read UID from the card.');
            process.exit(1); // Exit with error code
        }

        // Output UID and exit
        console.log(uid); // Output only the UID for Laravel
        process.exit(0); // Exit with success code
    });

    reader.on('error', err => {
        console.error(`Reader error: ${err.message}`);
        process.exit(1); // Exit with error code
    });

    reader.on('end', () => {
        console.log(`${reader.reader.name} reader disconnected`);
    });
});

nfc.on('error', err => {
    console.error('NFC error:', err.message);
    process.exit(1); // Exit with error code
});
