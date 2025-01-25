# Hotel Digital Menu System

This project is a Hotel Digital Menu System that allows users to view the menu, place orders, and manage tables. It also features an admin panel to manage dishes, tables, and orders. The system uses PHP and MySQL for backend operations, and JSON files for storing orders and table statuses.

## Table of Contents
1. [Project Overview](#project-overview)
2. [Installation](#installation)
3. [Usage](#usage)
4. [Folder Structure](#folder-structure)
5. [API Endpoints](#api-endpoints)
6. [Technologies Used](#technologies-used)
7. [License](#license)

---

## Project Overview

The Hotel Digital Menu System has two primary interfaces:
1. **Customer Interface:** A user-friendly digital menu where customers can view the dishes, place orders, and select a table.
2. **Admin Interface:** An admin panel to manage dishes, orders, and table statuses.

The system is built using PHP, MySQL, and JavaScript. It supports functionalities like:
- Viewing and filtering dishes by category.
- Placing orders and updating table statuses.
- Adding, updating, and managing the menu from the admin panel.

---

## Installation

### Prerequisites
Ensure you have the following installed on your machine:
- **PHP** (7.x or higher)
- **MySQL**
- **Apache or Nginx** (for hosting PHP files)
- **Node.js** (for frontend JS functionalities)

### Steps

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/hotel-digital-menu.git
   cd hotel-digital-menu
   ```

2. **Set up the database:**
   - Create a MySQL database (e.g., `hotel_menu`).
   - Import the database schema (`db.sql`) to set up the necessary tables.
   
3. **Configure Database Connection:**
   - In `db.php`, update the database credentials (username, password, database name) to match your local MySQL setup.

4. **Start the server:**
   - If you're using Apache:
     - Place the files in your Apache's `htdocs` folder (or configure your virtual host accordingly).
     - Start the Apache server.
   - If using Nginx, set up the server block for your project.

5. **Install Dependencies:**
   - Run `npm install` if you have Node.js dependencies to install for frontend operations.

---

## Usage

1. **Customer Side:**
   - Open `index.html` to view the digital menu.
   - Browse through the categories and select items to order.
   - Select a table and view the order summary.
   - Place or clear your order.

2. **Admin Side:**
   - Open `admin.html` to manage the menu and orders.
   - Add new dishes, manage table statuses, and view all orders.
   - The admin panel provides functionalities like adding a new dish, updating table status, and viewing the list of orders placed by customers.

3. **Managing Tables:**
   - Admins can mark tables as `available` or `occupied` by updating the status through the admin panel.

4. **Order Management:**
   - Orders placed by customers are saved in the `orders.json` file.
   - Admins can view and manage these orders.

---

## Folder Structure

The project is organized as follows:

```
hotel-digital-menu/
├── php/
│   ├── db.php               # Database connection
│   ├── menu.php              # Get menu items
│   ├── order.php             # Place new orders
│   ├── signup.php            # User signup functionality
│   ├── tables.json           # Table statuses
│   ├── updateTable.php       # Update table status
│   └── updateTableStatus.php # Handle table status updates
├── css/
│   ├── admin.css             # Admin panel styles
│   └── mainPage.css          # Customer side styles
├── js/
│   ├── admin.js              # Admin-side JavaScript
│   └── main.js               # Customer-side JavaScript
├── index.html                # Customer's main page
├── admin.html                # Admin panel page
└── db.sql                    # MySQL database schema
```

---

## API Endpoints

### 1. **GET /menu.php**
   - **Description:** Fetches the list of dishes based on the selected category (optional).
   - **Query Parameters:**
     - `category`: (optional) The category to filter dishes by.
   - **Response:** JSON array of dishes.

### 2. **POST /order.php**
   - **Description:** Allows users to place an order.
   - **Request Body:** 
     - `table`: The table number.
     - `order`: An array of ordered dishes (with ID, name, and quantity).
     - `total`: The total amount of the order.
   - **Response:** JSON success or error message.

### 3. **POST /signup.php**
   - **Description:** Allows users to sign up by providing their username, email, password, and role.
   - **Request Body:**
     - `username`: User's name.
     - `email`: User's email.
     - `password`: User's password.
     - `role`: User's role (default is `staff`).
   - **Response:** JSON success or error message.

### 4. **POST /updateTable.php**
   - **Description:** Updates the status of a table to `occupied`.
   - **Request Body:** 
     - `table`: The table number.
   - **Response:** JSON success or error message.

---

## Technologies Used

- **Frontend:**
  - HTML5
  - CSS3
  - JavaScript (for dynamic content and interactivity)

- **Backend:**
  - PHP (for handling requests and database operations)
  - MySQL (for storing user data, orders, and menu items)
  
- **File Handling:**
  - JSON (for storing orders and table statuses)

---

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

Pramish Bhandari
