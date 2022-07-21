export {};
declare global { interface Window { onHandleIsDone: any } }
window.onHandleIsDone = require("./func").onHandleIsDone
