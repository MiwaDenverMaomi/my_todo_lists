/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/ts/func.ts":
/*!******************************!*\
  !*** ./resources/ts/func.ts ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "onChangeTitle": () => (/* binding */ onChangeTitle),
/* harmony export */   "onEndEditMode": () => (/* binding */ onEndEditMode),
/* harmony export */   "onHandleIsDone": () => (/* binding */ onHandleIsDone),
/* harmony export */   "onStartEditMode": () => (/* binding */ onStartEditMode),
/* harmony export */   "onSubmitTitle": () => (/* binding */ onSubmitTitle)
/* harmony export */ });
//is_done:any->because the value passed from blade is 1 or 0. Convert them into string in php by wrapping '', and cast them to boolean in JavaScript.
var onHandleIsDone = function onHandleIsDone($todo_id, route) {
  console.log('onHandleIsDone');
  var $todo_form_element = document.querySelector("#todo_form");
  var $check_todo_element = document.querySelector("#check_todo_id");
  $check_todo_element.value = $todo_id;
  $todo_form_element.action = "/todo-list/is-done/".concat($todo_id);
  $todo_form_element.method = 'post';
  $todo_form_element.submit();
};
var onStartEditMode = function onStartEditMode(todo_id, prev_title, is_done) {
  console.log('onStartEditMode');
  is_done === '1' ? true : false; // document.querySelector<any>(`#todo_display_${todo_id}`).outerHTML=`<input id=todo_title_${todo_id} class="" name="title" type="text" onblur={onEndEditMode(${todo_id},'${prev_title}',${is_done})} onKeydown="(e)=>onSubmitTitle(${todo_id},'${prev_title}',${is_done},e)">`;

  document.querySelector("#todo_display_".concat(todo_id)).outerHTML = "<input id=todo_title_".concat(todo_id, " class=\"\" name=\"title\" type=\"text\" onblur=\"onEndEditMode(").concat(todo_id, ",'").concat(prev_title, "',").concat(is_done, ")\">");
};
var onEndEditMode = function onEndEditMode(todo_id, prev_title, is_done) {
  console.log('onEndEditMode');
  is_done === '1' ? true : false;
  document.querySelector("#todo_title_".concat(todo_id)).outerHTML = "<p id=\"todo_display_".concat(todo_id, "\" class=\"").concat(is_done ? 'textdecoration-linethrough' : '', "\" onclick=\"onStartEditMode(").concat(todo_id, ",'").concat(prev_title, "',").concat(is_done, ")\">").concat(prev_title, "</p>");
};
var onChangeTitle = function onChangeTitle(todo_id) {
  console.log('onChangeTitle');
  document.querySelector("#todo_title_".concat(todo_id)).addEventListener('change', function (e) {
    document.querySelector("#todo_title_".concat(todo_id)).value = e.target.value;
  });
};
var onSubmitTitle = function onSubmitTitle(todo_id, prev_title, is_done) {
  console.log('onSubmit');
  console.log('enter pressed!');
  is_done === '1' ? true : false;
  var $todo_title_form_element = document.querySelector("#todo_title_form");

  if ($todo_title_form_element.value.length === 0 || $todo_title_form_element.value === prev_title) {
    console.log('$todo_title_form_element.value:' + $todo_title_form_element.value);
    console.log('$todo_title_form_element.value.length:' + $todo_title_form_element.value.length);
    console.log('prev.title===$todo_title_form_element.value:' + $todo_title_form_element.value === prev_title);
    document.querySelector("#todo_title_".concat(todo_id)).outerHTML = "<p id=\"todo_display_".concat(todo_id, "\" class=\"").concat(is_done ? 'textdecoration-linethrough' : '', "\" onclick=\"onStartEditMode(").concat(todo_id, ",'").concat(prev_title, "','").concat(is_done, "')\">").concat(prev_title, "</p>");
  } else {
    $todo_title_form_element.method = "post";
    $todo_title_form_element.action = "/todo-list/update-title/".concat(todo_id); //Not working?

    $todo_title_form_element.submit();
  }
};

/***/ }),

/***/ "./resources/ts/index.ts":
/*!*******************************!*\
  !*** ./resources/ts/index.ts ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
window.onHandleIsDone = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").onHandleIsDone);
window.onStartEditMode = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").onStartEditMode);
window.onEndEditMode = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").onEndEditMode);
window.onChangeTitle = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").onChangeTitle);
window.onSubmitTitle = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").onSubmitTitle);


/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/func": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/ts/func.ts")))
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/ts/index.ts")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/sass/app.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;