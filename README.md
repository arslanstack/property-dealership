# Laravel REST APIs and Admin Panel for Property Dealership Web App

This repository provides a Laravel 10 REST APIs and Bootstrap based admin dashboard for a property dealership web application.

## Getting Started

### Clone the Repository

Clone the repository using the following command:

```bash
git clone https://github.com/arslanstack/property-dealership.git
```
### Installation

After cloning the project, navigate into the project directory and install dependencies:

```bash
cd property-dealership
composer install
```

### Configuration

1. Copy the example .env file:

```bash
cp .env.example .env
```

2. Generate the application key:

```bash
php artisan key:generate
```

3. Update the .env file:
Open the .env file in a text editor and update the necessary configuration values, such as database connection details. Example:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=property_dealership
DB_USERNAME=root
DB_PASSWORD=
```

### Database Setup

1. Create a new MySQL database:
Create new database using phpmyadmin or mysql workbench


2. Run the migrations:

```bash
php artisan migrate
```
### Running the Application

Start the Laravel server and compile assets:

```bash
php artisan serve
```

### Contributing

After implementing a feature or fix, use the following commands to commit and push your changes:

```bash
git add .
git commit -m "Describe the feature"
git push -u origin
```

### Snapshots

<img src="./snaps/1.png" alt="Project Banner">
<img src="./snaps/1-5.png" alt="Project Banner">
<img src="./snaps/1-6.png" alt="Project Banner">
<img src="./snaps/1-7.png" alt="Project Banner">
<img src="./snaps/2.png" alt="Project Banner">
<img src="./snaps/3.png" alt="Project Banner">
<img src="./snaps/4.png" alt="Project Banner">
<img src="./snaps/5.png" alt="Project Banner">
<img src="./snaps/6.png" alt="Project Banner">

