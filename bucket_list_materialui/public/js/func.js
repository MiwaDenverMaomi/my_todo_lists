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
/* harmony export */   "checkComments": () => (/* binding */ checkComments),
/* harmony export */   "checkEmail": () => (/* binding */ checkEmail),
/* harmony export */   "checkMaxLen": () => (/* binding */ checkMaxLen),
/* harmony export */   "checkMinLen": () => (/* binding */ checkMinLen),
/* harmony export */   "checkName": () => (/* binding */ checkName),
/* harmony export */   "checkPassword": () => (/* binding */ checkPassword),
/* harmony export */   "checkPhoto": () => (/* binding */ checkPhoto),
/* harmony export */   "checkRequired": () => (/* binding */ checkRequired),
/* harmony export */   "checkTodo": () => (/* binding */ checkTodo),
/* harmony export */   "checkValidEmail": () => (/* binding */ checkValidEmail),
/* harmony export */   "checkValidPhoto": () => (/* binding */ checkValidPhoto),
/* harmony export */   "onChangeTitle": () => (/* binding */ onChangeTitle),
/* harmony export */   "onEndEditMode": () => (/* binding */ onEndEditMode),
/* harmony export */   "onHandleIsDone": () => (/* binding */ onHandleIsDone),
/* harmony export */   "onHandleSelectPhoto": () => (/* binding */ onHandleSelectPhoto),
/* harmony export */   "onStartEditMode": () => (/* binding */ onStartEditMode),
/* harmony export */   "onSubmitProfile": () => (/* binding */ onSubmitProfile),
/* harmony export */   "onSubmitTitle": () => (/* binding */ onSubmitTitle),
/* harmony export */   "previewFile": () => (/* binding */ previewFile),
/* harmony export */   "sanitize": () => (/* binding */ sanitize)
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
  is_done === '1' ? true : false;
  document.querySelector("#todo_display_".concat(todo_id)).outerHTML = "<input id=todo_title_".concat(todo_id, " class=\"\" name=\"title\" type=\"text\" onblur=\"onEndEditMode(").concat(todo_id, ",'").concat(prev_title, "','").concat(is_done, "')\"></input>");
  var $todo_title_element = document.querySelector("#todo_title_".concat(todo_id));
  console.log($todo_title_element);
  onChangeTitle(todo_id, prev_title, is_done);
};
var onEndEditMode = function onEndEditMode(todo_id, prev_title, is_done) {
  console.log('onEndEditMode');
  is_done === '1' ? true : false;
  var $todo_title_element = document.querySelector("#todo_title_".concat(todo_id));
  console.log($todo_title_element);
  $todo_title_element.innerHTML = "<p id=\"todo_display_".concat(todo_id, "\" class=\"").concat(is_done ? 'textdecoration-linethrough' : '', "\" onclick=\"onStartEditMode(").concat(todo_id, ",'").concat(prev_title, "','").concat(is_done, "')\">").concat(prev_title, "</p>"); //outerHTMLじゃダメなのでinnerHTMLにしたらエラー解決。<input><p></p>となっているがこれでOK？
};
var onChangeTitle = function onChangeTitle(todo_id, prev_title, is_done) {
  console.log('onChangeTitle');
  var $todo_title_element = document.querySelector("#todo_title_".concat(todo_id));

  $todo_title_element.onkeypress = function (e) {
    is_done === '1' ? true : false;
    var key = e.keyCode || e.charCode || 0;
    console.log(e.keyCode);

    if (e.keyCode == 13) {
      //ひとつもキー入力しないでEnter->submitにいく。ひとつでもキー入力してEnter->e.keyCode==13判定
      //ここにpreventDefault()を入れると、submitされてもnameに値が入っておらず（気がする）エラーとなる。
      $todo_title_element.value = sanitize($todo_title_element.value);
      console.log('enter pressed!');

      if ($todo_title_element.value.length === 0 || $todo_title_element.value === prev_title || $todo_title_element === undefined) {
        e.preventDefault();
        console.log('$todo_title_element.value:' + $todo_title_element.value);
        console.log('$todo_title_element.value.length:' + $todo_title_element.value.length);
        console.log('prev.title===$todo_title_form_element.value:' + $todo_title_element.value === prev_title);
        console.log($todo_title_element);
        onEndEditMode(todo_id, prev_title, is_done);
      } else {
        onSubmitTitle(todo_id);
      }
    }
  };
};
var onSubmitTitle = function onSubmitTitle(todo_id) {
  console.log('onSubmit');
  var $todo_title_form_element = document.querySelector("#todo_title_form");
  $todo_title_form_element.method = "post";
  $todo_title_form_element.action = "/todo-list/update-title/".concat(todo_id); //Not working?

  $todo_title_form_element.submit();
}; //sanitize

var sanitize = function sanitize(str) {
  return String(str).replace(/&/g, "&amp;").replace(/"/g, "&quot;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
};
var onHandleSelectPhoto = function onHandleSelectPhoto(photo) {
  var sizeLimit = 2560 * 1920 * 1;
  var $inputPhoto = document.querySelector('#input_photo');
  var $photoFrame = document.querySelector('#photo_frame');
  var photos = $inputPhoto.files !== null ? $inputPhoto.files : ['./img/no_image.jpg'];

  if (photo !== null) {
    var $photo_err_element = document.querySelector('#photo_err');
    var photoErrMsgs = checkPhoto(photo);
    photos.map(function (item) {
      if (photoErrMsgs.length > 0) {
        $inputPhoto.value = '';
        $photo_err_element.innerText = photoErrMsgs[0];
      } else {
        $photoFrame.innerHTML = "<img src=\"".concat(item, "\" alt=\"").concat(name === null ? 'No name' : name, "\">");
        $photo_err_element.innerText = '';
        photoErrMsgs = [];
      }
    });
  }
};
var previewFile = function previewFile(file) {
  var preview = document.querySelector('#preview');
  var reader = new FileReader();

  reader.onload = function (e) {
    var imageURL = e.target.result;
    var img = document.createElement("img");
    img.src = imageURL;
    preview.appendChild(img);
  };

  reader.readAsDataURL(file);
};
var onSubmitProfile = function onSubmitProfile(user_id) {
  var $name_element = document.querySelector('#name');
  var $photo_element = document.querySelector('#photo');
  var $comment1_element = document.querySelector('#comment1');
  var $comment2_element = document.querySelector('#comment2');
  var $comment3_element = document.querySelector('#comment3');
  var $photo_err_element = document.querySelector('#photo_err');
  var $name_err_element = document.querySelector('#name_err');
  var $comment1_err_element = document.querySelector('#comment1_err');
  var $comment2_err_element = document.querySelector('#comment2_err');
  var $comment3_err_element = document.querySelector('#comment3_err');
  var errMsgs = {
    email: [],
    name: [],
    photo: [],
    comment1: [],
    comment2: [],
    comment3: []
  };
  var nameCheckResult = checkName($name_element.value);
  var photoCheckResult = checkPhoto($photo_element.value);
  var comment1CheckResult = checkComments($comment1_element.value);
  var comment2CheckResult = checkComments($comment2_element.value);
  var comment3CheckResult = checkComments($comment3_element.value);
  errMsgs = Object.assign(Object.assign({}, errMsgs), {
    name: nameCheckResult,
    photo: photoCheckResult,
    comment1: comment1CheckResult,
    comment2: comment2CheckResult,
    comment3: comment3CheckResult
  });
  var errs = errMsgs.map(function (item) {
    if (item.length > 0) {
      return false;
    }
  });

  if (errs === false) {
    $photo_err_element.innerHTML = errMsgs.photo[1];
    $name_err_element.innerHTML = errMsgs.name[1];
    $comment1_err_element.innerHTML = errMsgs.comment1[1];
    $comment2_err_element.innerHTML = errMsgs.comment2[1];
    $comment3_err_element.innerHTML = errMsgs.comment3[1];
  } else {
    var $profile_form_element = document.querySelector('#profile_form');
    errMsgs = {
      email: [],
      name: [],
      photo: [],
      comment1: [],
      comment2: [],
      comment3: []
    };
    $profile_form_element.method = "post";
    $profile_form_element.action = "\"/".concat(user_id, "/edit-profile\"");
    $profile_form_element.submit();
  }
}; //validation

var checkRequired = function checkRequired(str) {
  if (str.length === 0) {
    return 'Input required.';
  }
};
var checkMinLen = function checkMinLen(str) {
  var num = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 7;

  if (str.length < num) {
    return "Input more than ".concat(num, " letters.");
  } else {
    return '';
  }
};
var checkMaxLen = function checkMaxLen(str) {
  var num = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 255;

  if (str.length > num) {
    return "Input less than ".concat(num, " letters.");
  } else {
    return '';
  }
};
var checkValidEmail = function checkValidEmail(email) {
  var pattern = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/;

  if (!pattern.test(email)) {
    return 'Input valid email address.';
  } else {
    return '';
  }
};
var checkValidPhoto = function checkValidPhoto(photo) {
  var sizeLimit = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 2560 * 1920 * 1;
  var mb = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 5;

  if (photo.size > sizeLimit) {
    return "Upload less than ".concat(mb, " MB.");
  } else {
    return '';
  }
};
var checkEmail = function checkEmail(email) {
  var errs = [];
  var checkValidEmailResult = checkValidEmail(email);
  var checkMaxLenResult = checkMaxLen(email);
  var checkMinLenResult = checkMinLen(email);
  var checkRequiredResult = checkRequired(email);

  if ((checkValidEmailResult === null || checkValidEmailResult === void 0 ? void 0 : checkValidEmailResult.length) > 0) {
    errs.push(checkValidEmailResult);
  }

  if ((checkMaxLenResult === null || checkMaxLenResult === void 0 ? void 0 : checkMaxLenResult.length) > 0) {
    errs.push(checkMaxLenResult);
  }

  if ((checkMinLenResult === null || checkMinLenResult === void 0 ? void 0 : checkMinLenResult.length) > 0) {
    errs.push(checkMinLenResult);
  }

  if ((checkRequiredResult === null || checkRequiredResult === void 0 ? void 0 : checkRequiredResult.length) > 0) {
    errs.push(checkRequiredResult);
  }

  return errs;
};
var checkPassword = function checkPassword(password) {
  var errs = [];
  var checkMaxLenResult = checkMaxLen(password);
  var checkMinLenResult = checkMinLen(password);
  var checkRequiredResult = checkRequired(password);

  if ((checkMaxLenResult === null || checkMaxLenResult === void 0 ? void 0 : checkMaxLenResult.length) > 0) {
    errs.push(checkMaxLenResult);
  }

  if ((checkMinLenResult === null || checkMinLenResult === void 0 ? void 0 : checkMinLenResult.length) > 0) {
    errs.push(checkMinLenResult);
  }

  if ((checkRequiredResult === null || checkRequiredResult === void 0 ? void 0 : checkRequiredResult.length) > 0) {
    errs.push(checkRequiredResult);
  }

  return errs;
};
var checkName = function checkName(name) {
  var errs = [];
  var checkMaxLenResult = checkMaxLen(name);

  if ((checkMaxLenResult === null || checkMaxLenResult === void 0 ? void 0 : checkMaxLenResult.length) > 0) {
    errs.push(checkMaxLenResult);
  }

  return errs;
};
var checkPhoto = function checkPhoto(photo) {
  var errs = [];
  var checkValidPhotoResult = checkValidPhoto(photo);

  if ((checkValidPhotoResult === null || checkValidPhotoResult === void 0 ? void 0 : checkValidPhotoResult.length) > 0) {
    errs.push(checkValidPhotoResult);
  }

  return errs;
};
var checkComments = function checkComments(comment) {
  var errs = [];
  var checkMaxLenResult = checkMaxLen(comment);

  if ((checkMaxLenResult === null || checkMaxLenResult === void 0 ? void 0 : checkMaxLenResult.length) > 0) {
    errs.push(checkMaxLenResult);
  }

  return errs;
};
var checkTodo = function checkTodo(todo) {
  var errs = [];
  var checkMaxLenResult = checkMaxLen(todo);
  var checkRequiredResult = checkRequired(todo);

  if ((checkMaxLenResult === null || checkMaxLenResult === void 0 ? void 0 : checkMaxLenResult.length) > 0) {
    errs.push(checkMaxLenResult);
  }

  if ((checkRequiredResult === null || checkRequiredResult === void 0 ? void 0 : checkRequiredResult.length) > 0) {
    errs.push(checkRequiredResult);
  }

  return errs;
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
window.sanitize = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").sanitize);
window.onHandleSelectPhoto = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").onHandleSelectPhoto);
window.previewFile = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").previewFile);
window.onSubmitProfile = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").onSubmitProfile);
window.checkRequired = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").checkRequired);
window.checkMinLen = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").checkMinLen);
window.checkMaxLen = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").checkMinLen);
window.checkValidEmail = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").checkValidEmail);
window.checkValidPhoto = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").checkValidPhoto);
window.checkEmail = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").checkEmail);
window.checkPassword = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").checkPassword);
window.checkName = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").checkName);
window.checkPhoto = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").checkPhoto);
window.checkComments = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").checkComments);
window.checkTodo = (__webpack_require__(/*! ./func */ "./resources/ts/func.ts").checkTodo);


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