// Import necessary modules using ES module syntax
import dotenv from 'dotenv';
import express from 'express';
import bodyParser from 'body-parser';
import path from 'path';
import fs from 'fs';
import { fileURLToPath } from 'url';

console.log("Environment Variables Loaded:");

// Configure dotenv to load environment variables
dotenv.config();

// Handle __dirname in ES modules
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Initialize Express app
const app = express();
const PORT = process.env.PORT || 3000;

console.log("App running…");

// Function to serve index.html (optional if not used)
function response(req, res) {
    fs.readFile(path.join(__dirname, 'public', 'index.html'), function (err, data) {
        if (err) {
            res.writeHead(500);
            return res.end('Failed to load file index.html');
        }
        res.writeHead(200);
        res.end(data);
    });
}


// Middleware
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

// Serve static files (like CSS and JS)
app.use(express.static(path.join(__dirname, 'public')));

// Routes for different HTML pages
app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

app.get('/about', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'about.html'));
});

app.get('/contact', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'contact.html'));
});

app.get('/project', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'projects.html'));
});

app.get('/apply', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'apply.html'));
});

app.get('/conact', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'apply.html'));
});

// Start the server
app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});
