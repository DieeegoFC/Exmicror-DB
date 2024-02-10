# Exmicror

Welcome to the central repository of Exmicror, a leading manufacturer and distributor of hand sanitizers. This project encapsulates both the essential database and the codebase of our web application built with Laravel. From order management to inventory control and customer interactions, Exmicror is the heart of our infrastructure.

## Project structure

- **`/sql`**: Contains the `init.sql` script for database initialization.
- **`/docs`**: Relevant documentation for the development and use of the database.
- **`/dump`**: Directory containing CSV files for test data. Data is automatically loaded into the database on container startup.
- **`/exmicror`**: Directory containing the Laravel web application codebase.

## Environment setup

1. Clone this repository: `git clone git@github.com:DieeegoFC/Exmicror-DB.git`
2. Ensure you have Docker installed in your environment.
3. Create a `.env` file in the root directory and provide the necessary database credentials.

```env
DB_NAME=your_database_name
DB_USER=your_database_user
DB_PASSWORD=your_database_password
```

4. Create a `.env` file in the root directory of the Laravel application (/exmicror) and provide the necessary database credentials (check exmicror/.env.example).

## Start database with Docker

```bash
docker-compose up -d
```

The database will be available at localhost:5432 with the credentials specified in the docker-compose.yml file.

## Contact

For inquiries or collaborations, reach out to our development team: bitbusters@fake.com.

Thank you for being a part of Exmicror! 🌐✨