require("dotenv").config();
const express = require("express");
const db = require("./db/db");
const path = require("path");

const app = express();
app.use(express.urlencoded({ extended: true }));
app.use(express.static("public"));
app.set("view engine", "ejs");

// Load home page
app.get("/", async (req, res) => {
    const [rows] = await db.query("SELECT * FROM employee ORDER BY id DESC LIMIT 3");
    res.render("index", { employees: rows, msg: null });
});

// Handle form submit
app.post("/", async (req, res) => {
    const { name, mobile } = req.body;

    await db.query("INSERT INTO employee (name, mobile) VALUES (?, ?)", [name, mobile]);

    const [rows] = await db.query("SELECT * FROM employee ORDER BY id DESC LIMIT 3");

    res.render("index", { employees: rows, msg: "Employee added successfully!" });
});

// Start server
app.listen(3000, () => {
    console.log("Node server running on port 3000");
});
