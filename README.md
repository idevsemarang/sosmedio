# Sosmedio

A simple social media platform built for educational purposes.

---

## About the Project

**Sosmedio** is a basic social media application created by **iDev Semarang** as a practical learning tool. This project is ideal for those who want to get hands-on experience with fundamental web development concepts using a combination of native technologies.

---

## Key Technologies Used 💻

* **Native PHP:** Handles server-side logic.
* **jQuery:** A fast, feature-rich JavaScript library for front-end interactivity.
* **Bootstrap 5:** A powerful front-end toolkit for building responsive, mobile-first sites.
* **MySQL:** A relational database management system for storing user data, posts, and more.
* **API Concept:** Demonstrates how to create and use basic APIs for data exchange.

---

## Features

* **User Authentication:** Secure user registration and login.
* **Create & View Posts:** Users can create and view social media posts.
* **Database Integration:** Data persistence using a MySQL database.
* **Responsive Design:** A clean and responsive user interface thanks to Bootstrap 5.
* **API Endpoints:** Basic API implementation for fetching and sending data.

---

## Getting Started

### Prerequisites

Before you begin, make sure you have the following installed:

* A web server with **PHP** support (e.g., XAMPP, Laragon)
* **MySQL** database

### Installation

1.  Clone or download this repository
2.  Navigate to the project directory and make sure the project folder name is sosmedio
3.  Set up your database:
    * Create a new MySQL database named `idev_sosmedio`.
    * Import the provided database schema (docs/idev_sosmedio.sql).
4.  Update the database connection details in your configuration file (app/DbConfig.php) to match your local setup.
5.  Navigate to assets/js/script.js and adjust the base url according to your project location, for example
    ```bash
    const baseUrl = "http://localhost/sosmedio";
    ```
6.  Start your web server and open the project in your browser via http://localhost/sosmedio.

---

## License

This project is open-source and available under the **MIT License**.
