⚽ Football Agency Backend

A lightweight, structured PHP backend designed for managing players, transfers, scouting, contracts, roles & permissions for a football agency platform.

This backend was built with pure PHP (no frameworks), focusing on simplicity, speed, and full control over application logic.

 Features

✔ User authentication (Login + Role-Based Access)
✔ Admin dashboard to manage all users
✔ Player management (CRUD)
✔ Transfers module (CRUD)
✔ Contracts module
✔ Scouting reports
✔ Role & permission system (RBAC)
✔ Database modeling with MySQL
✔ Clean folder structure
✔ Secure form handling & input validation
✔ Fully modular controllers
✔ Reusable database connection
✔ Extendable architecture for future mobile or frontend apps

📂 Project Structure
/config
    db.php                → Database connection file

/controllers
    auth.php              → Authentication logic
    user_crud.php         → Create, update, delete users
    roles_crud.php        → Manage roles
    permissions_crud.php  → Manage permissions
    transfers_crud.php    → Transfer logic
    contract_crud.php     → Player contracts
    scouting_crud.php     → Scouting data

/models
    users.php             → User model
    roles.php             → Role model
    permissions.php       → Permission model
    transfers.php         → Transfers model
    contracts.php         → Contracts model
    scouting.php          → Scouting model

/pages
    login.php             → Login page
    dashboard.php         → Admin dashboard
    users.php             → View all users
    edit_user.php         → Edit user details
    roles_form.php        → Create/Edit role
    permissions_form.php  → Assign permissions
    transfers_form.php    → Create transfers
    contracts_form.php    → Create contracts
    style.css             → Global styling

🛠 Tech Stack
Component	Technology
Backend	PHP (No Framework)
Database	MySQL
Architecture	MVC-Inspired Modular Structure
Server	Apache / XAMPP / LAMP / WAMP


Version Control	Git & GitHub

🧩 Installation & Setup
1. Clone the repository
git clone https://github.com/codesilentkiller/football-agency-backend.git

2. Move into project
cd football-agency-backend

3. Import the database

Import the SQL file:

sql/schema.sql

4. Configure environment

Open:

config/db.php


And set your own database credentials:

$host = "localhost";
$user = "root";
$pass = "";
$db   = "football_agency";

5. Start local server

If using XAMPP:

http://localhost/football-agency-backend/pages/login.php


Login using your admin credentials (stored in DB).

🔐 Authentication & Authorization

The system uses a simple Role-Based Access Control (RBAC) structure:

Users

Roles

Permissions

Role-Permissions

User-Roles

This makes it easy to manage:

✔ Admins
✔ Scouts
✔ Agents
✔ Club Owners
✔ Standard Users

You can assign any permission to any role.

📌 API Endpoints (Optional)

Since the project uses PHP pages, you can convert it into an API later.

To future-proof your system, controllers already follow:

create_xxx()
update_xxx()
delete_xxx()
get_xxx()


So migrating to REST API is easy.

🚀 Future Enhancements

These can be added later:

JWT Authentication (API Ready)

Upload player images & documents

Admin activity logs

Contract PDF generator

Notifications (Email / SMS)

Full REST API version

Mobile app integration (Flutter or React Native)

Club analytics dashboard

👨‍💻 Author

codesilentkiller
Backend Developer | PHP | Laravel | API Architecture
📧 mosesbangura001@gmail.com

📄 License

This project is open-source and free to use.
