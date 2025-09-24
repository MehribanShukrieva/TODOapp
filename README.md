#  TODO App

A simple and clean ToDo web application built with **Laravel 10** and **PHP 8**.  
Manage your projects and tasks fast, no fluff, just productivity.

---

##  Features

- User registration & login
- Profile management (edit email & password)
- Create, view, edit, and delete projects
- Add, edit, and delete tasks inside projects
- Task statuses: **todo**, **in_progress**, **done**
- Only your data – secure access

---

##  Demo Account

Explore the app without signing up:

- **Email:** demo@todo.test  
- **Password:** demo12345  

**Try it out:**  
1. Login with the demo account  
2. Go to `/projects`  
3. Add projects & tasks  
4. Edit or delete as you like  

---

##  Quick Start

```bash
git clone https://github.com/MehribanShukrieva/TODOapp.git
cd TODOapp
composer install
npm install
npm run dev
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Open `http://127.0.0.1:8000` in your browser and start managing your projects.

---

## 🛠 Usage

- Login / register
- Create projects
- Inside a project, add tasks
- Change task statuses: `todo` → `in_progress` → `done`
- Edit or delete projects and tasks

---

## 📡 API (Optional)

- `POST /register` — register
- `POST /login` — login
- `POST /logout` — logout
- `GET /projects` — list projects
- `POST /projects` — create project
- `GET /projects/{id}` — project details
- `PUT /projects/{id}` — update project
- `DELETE /projects/{id}` — delete project
- `GET /projects/{id}/tasks` — list tasks
- `POST /projects/{id}/tasks` — create task
- `PUT /tasks/{id}` — update task
- `DELETE /tasks/{id}` — delete task

---
