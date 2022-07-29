export {};// necessary
declare global { interface Window {
  onHandleIsDone: any,
  onStartEditMode:any,
  onEndEditMode:any,
  onChangeTitle:any,
  onSubmitTitle:any,
  sanitize:any,
  onHandleSelectPhoto:any,
  previewFile:any,
  onSubmitProfile:any,
  checkRequired:any,
  checkMinLen:any,
  checkMaxLen:any,
  checkValidEmail:any,
  checkValidPhoto:any,
  checkEmail:any,
  checkPassword:any,
  checkName:any,
  checkPhoto:any,
  checkComments:any,
  checkTodo:any,
  searchKeyword:any,
  onToggleFavorite:any
 } }

window.onHandleIsDone = require("./func").onHandleIsDone;
window.onStartEditMode = require("./func").onStartEditMode;
window.onEndEditMode = require("./func").onEndEditMode;
window.onChangeTitle = require("./func").onChangeTitle;
window.onSubmitTitle = require("./func").onSubmitTitle;
window.sanitize = require("./func").sanitize;
window.onHandleSelectPhoto = require("./func").onHandleSelectPhoto;
window.previewFile=require("./func").previewFile;
window.onSubmitProfile=require("./func").onSubmitProfile;
window.checkRequired=require("./func").checkRequired;
window.checkMinLen=require("./func").checkMinLen;
window.checkMaxLen=require("./func").checkMinLen;
window.checkValidEmail=require("./func").checkValidEmail;
window.checkValidPhoto=require("./func").checkValidPhoto;
window.checkEmail=require("./func").checkEmail;
window.checkPassword=require("./func").checkPassword;
window.checkName=require("./func").checkName;
window.checkPhoto=require("./func").checkPhoto;
window.checkComments=require("./func").checkComments;
window.checkTodo=require("./func").checkTodo;
window.searchKeyword=require("./func").searchKeyword;
window.onToggleFavorite=require("./func").onToggleFavorite;
