export {};// necessary
declare global { interface Window {
  onHandleIsDone: any,
  onStartEditMode:any,
  onEndEditMode:any,
  onChangeTitle:any,
  onSubmitTitle:any,
  sanitize:any,

 } }
window.onHandleIsDone = require("./func").onHandleIsDone;
window.onStartEditMode = require("./func").onStartEditMode;
window.onEndEditMode = require("./func").onEndEditMode;
window.onChangeTitle = require("./func").onChangeTitle;
window.onSubmitTitle = require("./func").onSubmitTitle;
window.sanitize = require("./func").sanitize;
