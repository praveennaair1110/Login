const express = require('express');
const bodyParser = require('body-parser');
const path = require('path');

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static(path.join(__dirname, 'public')));

// Mock user data with passwords and user types
const users = {
    'admin@example.com': { password: 'adminpassword', userType: 'admin' },
    'employee@example.com': { password: 'employeepassword', userType: 'employee' },
    'supervisor@example.com': { password: 'supervisorpassword', userType: 'supervisor' },
};

// Route for login
app.post('/login', (req, res) => {
    const { username, password } = req.body;
    const user = users[username];

    // Check if user exists and password matches
    if (!user || user.password !== password) {
        res.status(401).send('Unauthorized: Invalid username or password');
        return;
    }

    // Send the appropriate HTML file based on user type
    switch (user.userType) {
        case 'admin':
            res.sendFile(path.join(__dirname, 'public', 'tool_inventory.html'));
            break;
        case 'employee':
            res.sendFile(path.join(__dirname, 'public', 'tool_request_form.html'));
            break;
        case 'supervisor':
            res.sendFile(path.join(__dirname, 'public', 'requested_items_list.html'));
            break;
        default:
            res.status(401).send('Unauthorized: Invalid user type');
    }
});

// Start server
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
