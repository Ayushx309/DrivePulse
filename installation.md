# Installation Guide for DrivePulse

DrivePulse is a comprehensive driving school management system that can be easily set up on your local environment. Follow these steps to get started:

## Prerequisites

- Local web server environment (e.g., XAMPP, WAMP, MAMP) with PHP and MySQL support.
- Composer installed on your system.

## Installation Steps

1. **Clone the Repository:**<br>`
git clone https://github.com/yourusername/drivepulse.git`.


2. **Database Setup:**
- Create a new MySQL database named 'billing' for the project.
- Import the provided SQL tables provided in [sql](sql/) folder of the project.

1. **Configuration:**
- Open `config.php` and update the database connection details.

1. **Install Dependencies:**
- Open your command line or terminal.
- Navigate to the project directory using `cd path/to/drivepulse`.
- Run `composer install` to install required PHP packages.

1. **Start Local Server:**
- Start your local web server environment (XAMPP, WAMP, MAMP).
- Make sure the server is running with PHP and MySQL services enabled.

1. **Access the Project:**
- Open your web browser.
- Visit `http://localhost/drivepulse` or the appropriate URL based on your local server setup.

1. **Initial Admin Login:**
- After successful setup, you can log in as the admin using the provided sample credentials:
  - Username: admin
  - Password: admin

## Contributing

- Fork the repository.
- Create a new branch for your changes: `git checkout -b feature/my-new-feature`
- Commit your changes: `git commit -am 'Add some feature'`
- Push to the branch: `git push origin feature/my-new-feature`
- Create a new Pull Request.

## License

This project is licensed under the [GNU General Public License](LICENSE), version v3.