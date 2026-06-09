require("./bootstrap");

import AOS from 'aos';
import 'aos/dist/aos.css';
AOS.init();

import ApexCharts from 'apexcharts';
window.ApexCharts = ApexCharts;

// Import Sweet Alert
import Swal from 'sweetalert2';
window.Swal = Swal;

import { createApp } from "vue";
import KanbanBoard from "./components/KanbanBoard.vue";
import AddTaskForm from "./components/AddTaskForm.vue";
import EditTaskForm from "./components/EditTaskForm.vue";

const app = createApp({});

app.component("kanban-board", KanbanBoard);
app.component("add-task-form", AddTaskForm);
app.component("edit-task-form", EditTaskForm);

if (document.getElementById("app")) {
    app.mount("#app");
}
