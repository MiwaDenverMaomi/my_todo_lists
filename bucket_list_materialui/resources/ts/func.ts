import { offset } from '@popperjs/core';
import { configureStore } from '@reduxjs/toolkit';
import axios from '../apis/axios';
// import axios from 'axios';

//is_done:any->because the value passed from blade is 1 or 0. Convert them into string in php by wrapping '', and cast them to boolean in JavaScript.

export const onHandleIsDone=($todo_id:number,route:string)=>{
	console.log('onHandleIsDone');

	const $todo_form_element=document.querySelector<any>("#todo_form");
	const $check_todo_element=document.querySelector<any>("#check_todo_id");

	$check_todo_element.value = $todo_id;
	$todo_form_element.action = `/todo-list/is-done/${$todo_id}`;
	$todo_form_element.method = 'post';
	$todo_form_element.submit();
};

export const onStartEditMode=(todo_id:number,prev_title:string,is_done:any)=>{
	console.log('onStartEditMode');

	is_done==='1'?true:false;

	document.querySelector<any>(`#todo_display_${todo_id}`).outerHTML=`<input id=todo_title_${todo_id} class="" name="title" type="text" onblur="onEndEditMode(${todo_id},'${prev_title}','${is_done}')"></input>`;

	const $todo_title_element=document.querySelector<any>(`#todo_title_${todo_id}`);
	console.log($todo_title_element);
	onChangeTitle(todo_id,prev_title,is_done);
};

export const onEndEditMode=(todo_id:number,prev_title:string,is_done:any)=>{
	console.log('onEndEditMode');

	is_done==='1'?true:false;
	const $todo_title_element=document.querySelector<any>(`#todo_title_${todo_id}`);
	console.log($todo_title_element);
	$todo_title_element.innerHTML=`<p id="todo_display_${todo_id}" class="${is_done?'textdecoration-linethrough':''}" onclick="onStartEditMode(${todo_id},'${prev_title}','${is_done}')">${prev_title}</p>`;//outerHTMLじゃダメなのでinnerHTMLにしたらエラー解決。<input><p></p>となっているがこれでOK？
};
export const onChangeTitle=(todo_id:number,prev_title:string,is_done:any)=>{
	console.log('onChangeTitle');
	const $todo_title_element=document.querySelector<any>(`#todo_title_${todo_id}`);


	$todo_title_element.onkeypress=(e:any)=>{
	is_done==='1'?true:false;

	const key=e.keyCode||e.charCode||0;
	console.log(e.keyCode);

	if(e.keyCode==13){//ひとつもキー入力しないでEnter->submitにいく。ひとつでもキー入力してEnter->e.keyCode==13判定
	//ここにpreventDefault()を入れると、submitされてもnameに値が入っておらず（気がする）エラーとなる。
	$todo_title_element.value=sanitize($todo_title_element.value);
	console.log('enter pressed!');

	 if($todo_title_element.value.length===0||$todo_title_element.value===prev_title||$todo_title_element===undefined){
		e.preventDefault();
			console.log('$todo_title_element.value:'+$todo_title_element.value);
			console.log('$todo_title_element.value.length:'+$todo_title_element.value.length);
			console.log('prev.title===$todo_title_form_element.value:'+$todo_title_element.value===prev_title);
			console.log($todo_title_element);

			onEndEditMode(todo_id,prev_title,is_done);

		 }else{
			 onSubmitTitle(todo_id);
		 }
		 }
	};
};

export const onSubmitTitle=(todo_id:number)=>{
	console.log('onSubmit');
	const $todo_title_form_element=document.querySelector<any>("#todo_title_form");
			$todo_title_form_element.method="post";
			$todo_title_form_element.action=`/todo-list/update-title/${todo_id}`;//Not working?
			$todo_title_form_element.submit();
};

//sanitize
export const sanitize=(str:any)=>{
	return String(str).replace(/&/g,"&amp;")
		.replace(/"/g,"&quot;")
		.replace(/</g,"&lt;")
		.replace(/>/g,"&gt;")
}

export const onHandleSelectPhoto=(name:string|null)=>{
	const sizeLimit = 3264 * 2448 * 1; //800万画素
	// const sizeLimit = 3968 * 2976 * 1; //iphone SE=>1200万画素->3968 * 2976 pixels.


	const $inputPhoto=document.querySelector<any>('#input_photo');
	const $photoFrame = document.querySelector<any>('#photo_frame');
	// const $photoPreview = document.querySelector<any>('#photo_preview');
	const $photoPreviewImage = document.querySelector<any>('#photo_preview_image');

	console.log($inputPhoto.files);
	// const photos=$inputPhoto.files!==null?$inputPhoto.files:[
	// 	'storage/img/no_image.jpg'
	// ];
	const photos = Array.from($inputPhoto.files);
	console.log(photos);
	// if(photos!==null){
	const $photo_err_element=document.querySelector<any>('#photo_err');
	let photoErrMsgs: string[] = checkPhoto(photos);

	photos.map((photo:any)=>{
		if (photoErrMsgs.length > 0) {
			console.log('file is too big');
			$inputPhoto.value='';
			$photo_err_element.innerText = photoErrMsgs[0];
			return;
		}
	const path = photo !== null ? URL.createObjectURL(photo):'./storage/img/no_image.jpg'
	$photoPreviewImage.setAttribute('src',path);
	// $photoPreview.style.display = 'block';
	$photo_err_element.innerText='';
	photoErrMsgs=[];
	});
	// }
}

export const previewFile=(file:any)=>{
 const preview=document.querySelector<any>('#preview');
 const reader=new FileReader();
 reader.onload=(e:any)=>{
	const imageURL=e.target.result;
	const img=document.createElement("img");
	img.src=imageURL;
	preview.appendChild(img);
 };
 reader.readAsDataURL(file);
}

export const onSubmitProfile=()=>{
	const $name_element=document.querySelector<any>('#name');
	const $photo_element=document.querySelector<any>('#photo');
	const $comment1_element=document.querySelector<any>('#comment1');
	const $comment2_element=document.querySelector<any>('#comment2');
	const $comment3_element=document.querySelector<any>('#comment3');
	const $photo_err_element=document.querySelector<any>('#photo_err');
	const $name_err_element=document.querySelector<any>('#name_err');
	const $comment1_err_element=document.querySelector<any>('#comment1_err');
	const $comment2_err_element=document.querySelector<any>('#comment2_err');
	const $comment3_err_element=document.querySelector<any>('#comment3_err');

	type ErrMsgs={
		email:string[],
		name:string[],
		photo:string[],
		comment1:string[],
		comment2:string[],
		comment3:string[],
	};
	let errMsgs:ErrMsgs={
		email:[],
		name:[],
		photo:[],
		comment1:[],
		comment2:[],
		comment3:[],
	}

	const nameCheckResult=checkName($name_element.value);
	const photoCheckResult=checkPhoto($photo_element.value);
	const comment1CheckResult=checkComments($comment1_element.value);
	const comment2CheckResult=checkComments($comment2_element.value);
	const comment3CheckResult=checkComments($comment3_element.value);

	errMsgs={...errMsgs,
		name:nameCheckResult,
		photo:photoCheckResult,
		comment1:comment1CheckResult,
		comment2:comment2CheckResult,
		comment3:comment3CheckResult
	}


	if(errMsgs.name!==[]||errMsgs.photo!==[]||errMsgs.comment1!==[]||errMsgs.comment2!==[]||errMsgs.comment3!==[]){
		$photo_err_element.innerHTML = errMsgs.name !== [] ?errMsgs.name[0]:'';
		$name_err_element.innerHTML = errMsgs.photo !== [] ?errMsgs.photo[0]:'';
		$comment1_err_element.innerHTML = errMsgs.comment1 !== [] ?errMsgs.comment1[0]:'';
		$comment2_err_element.innerHTML = errMsgs.comment2 !== [] ?errMsgs.comment2[0]:'';
		$comment3_err_element.innerHTML = errMsgs.comment3 !== [] ? errMsgs.comment3[0] : '';

	} else {

		const $profile_form_element=document.querySelector<any>('#profile_form');
		errMsgs={
			email:[],
			name:[],
			photo:[],
			comment1:[],
			comment2:[],
			comment3:[],
		};

		console.log('submit');
		$profile_form_element.submit();
	}
};

export const onToggleLike =async (user: number, is_liked_by_auth: number) => {
	console.log('onToggleLike');
	fetch(`http://localhost/user/store-like/${user}`, {
		method: 'POST',
		headers: {
			'X-Requested-With': 'XMLHttpRequest',
			'Accept': 'application/json',
			'Content-Type': 'application/json',
			'Credentials': 'include',
		},
		body: JSON.stringify({
			is_liked_by_auth: is_liked_by_auth === 1 ? true : false
		})
	}).then((res: any) => {

		if (!res.ok) {
			const err = res.json();
			const $likes_result_element = document.querySelector<any>(`#likes_result_${user}`);
			$likes_result_element.innerText = 'Failed to update like...sorry!';
			throw new Error(err);
		}
		return res.json();
	}).then((data: any) => {
		const $likes_result_element = document.querySelector<any>(`#likes_result_${user}`);
		const result = data;
		if (result?.is_liked_by_auth === true || result?.is_liked_by_auth === false) {
			const { is_liked_by_auth, count_likes } = result;
			const $heart_element = document.querySelector<any>(`#like-id_${user}`);
			const $count_likes_element = document.querySelector<any>(`#count_likes_${user}`);

			if (is_liked_by_auth === true) {
				$heart_element.classList.add('active');
			}else {
				$heart_element.classList.remove('active');
			}
			$count_likes_element.innerText = count_likes;

		} else if (result === undefined) {
			$likes_result_element.innerText = 'Failed to update like...sorry!';

		} else {
			$likes_result_element.innerText = result.error;
		}
	}).then((data: any) => data).catch((err: any) => {
		const $likes_result_element = document.querySelector<any>(`#likes_result_${user}`);
		$likes_result_element.innerText = err.responseerr.response
	});
}

export const onToggleFavorite=(user:number,is_favorite_by_auth:boolean)=>{
	console.log('onToggleFavorite');
	fetch(`http://localhost/user/store-favorite/${user}`, {
		method: 'POST',
		headers: {
			'X-Requested-With': 'XMLHttpRequest',
			'Accept': 'application/json',
			'Content-Type': 'application/json',
			'Credentials': 'include',
		},
		body: JSON.stringify({
			is_favorite_by_auth:is_favorite_by_auth
		})
	}).then((res: any) => {
		if (!res.ok) {
			const err = res.json();
			const $favorites_result_element = document.querySelector<any>(`#favorites_result_${user}`);
			$favorites_result_element.innerText = 'Failed to update like...sorry!';
			throw new Error(err);
		}
		return res.json();
	}).then((data: any) => {
		console.log(0);
			const result = data;
			console.log(data);
			const $favorites_result_element = document.querySelector<any>(`#favorites_result_${user}`);
			if (result.is_favorite_by_auth === true || result.is_favorite_by_auth === false) {
				console.log(1);
				const { is_favorite_by_auth} = result;
				const $star_element = document.querySelector<any>(`#favorite-id_${user}`);
				const $count_favorites_element = document.querySelector<any>(`#count_favorites_${user}`);

				if (is_favorite_by_auth === true) {
					console.log(2);
					$star_element.classList.add('active');
				} else {
					console.log(3);
					$star_element.classList.remove('active');
				}

			} else if (result === undefined) {
				console.log(4);
				$favorites_result_element.innerText = 'Failed to update favorite...sorry!';
			} else {
				console.log(5);
				$favorites_result_element.innerText = result.error;
			}
		 })
		.catch((err: any) => {
			const $favorites_result_element = document.querySelector<any>(`#favorites_result_${user}`);
			$favorites_result_element.innerText = err.response;
		});

}
export const searchKeyword=(str:string)=>{
	let result:any=axios.get('/search',{
		params:{
			keyword:str
		}
	}).then((res:any)=>res).catch((err:any)=>err);

	if(result===undefined){
		return {
			is_success:false,
			result:'Failed to search.Try again later.'
		}
	}else if(result.data.Response==='False'){
		return {
			is_success:false,
			result:'Failed to search.Try again later.'
		}
	}else{
		return {
			is_success:true,
			result:result.data
		}
	}
};

export const onToggleDescription=()=>{
	console.log('onOpenDescription');
	const $description_element = document.querySelector<any>('#description');
	if ($description_element.classList.contains('d-none')) {
		$description_element.classList.remove('d-none');
	} else {
		$description_element.classList.add('d-none');
	 }
}
//validation
// export const checkRequired=(str:string)=>{
// 	if(str.length===0){
// 		return 'Input required.';
// 	}else{
// 		return '';
// 	}
// };
export const checkRequired = (str: string) => {
	if (str.length === 0) {
		return 'Input required.';
	}
};

// export const checkMinLen=(str:string,num:number=7)=>{
// 	if(str.length<num){
// 		return `Input more than ${num} letters.`;
// 	}else{
// 		return '';
// 	}
// };
export const checkMinLen = (str: string, num: number = 7) => {
	if (str.length < num) {
		return `Input more than ${num} letters.`;
	}
};

// export const checkMaxLen=(str:string,num:number=255)=>{
// 	if(str.length>num){
// 		return `Input less than ${num} letters.`;
// 	}else{
// 		return '';
// 	}
// };
export const checkMaxLen = (str: string, num: number = 255) => {
	if (str.length > num) {
		return `Input less than ${num} letters.`;
	}
};

export const checkValidEmail=(email:string)=>{
	const pattern = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/;
	if(!pattern.test(email)){
		return 'Input valid email address.'
	}
};

// export const checkValidEmail = (email: string) => {
// 	const pattern = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/;
// 	if (!pattern.test(email)) {
// 		return 'Input valid email address.'
// 	} else {
// 		return '';
// 	}
// };

// export const checkValidPhoto=(photo:any,sizeLimit:number=2560*1920*1,mb:number=5)=>{
// 	if(photo.size>sizeLimit){
// 		return `Upload less than ${mb} MB.`;
// 	}else{
// 		return '';
// 	}
// };

export const checkValidPhoto = (photo: any, sizeLimit: number = 2560 * 1920 * 1, mb: number = 5) => {
	console.log('checkValidPhoto');
	if (photo !== null && photo.size > sizeLimit) {
		console.log('photo !== null && photo.size > sizeLimit');
		return `Upload less than ${mb} MB.`;
	}
};

export const checkEmail=(email:string)=>{
	let errs:string[]=[];
	const checkValidEmailResult=checkValidEmail(email);
	const checkMaxLenResult=checkMaxLen(email);
	const checkMinLenResult=checkMinLen(email);
	const checkRequiredResult=checkRequired(email);

	// if(checkValidEmailResult.length>0){
	// 	errs.push(checkValidEmailResult);
	// }

	// if(checkMaxLenResult?.length>0){
	// 	errs.push(checkMaxLenResult);
	// }

	// if(checkMinLenResult?.length>0){
	// 	errs.push(checkMinLenResult);
	// }

	// if(checkRequiredResult?.length>0){
	// 	errs.push(checkRequiredResult);
	// }

	if (checkValidEmailResult !== undefined && checkValidEmailResult.length > 0) {
		errs.push(checkValidEmailResult);
	}

	if (checkMaxLenResult !== undefined && checkMaxLenResult.length > 0) {
		errs.push(checkMaxLenResult);
	}

	if (checkMinLenResult!==undefined&&checkMinLenResult?.length > 0) {
		errs.push(checkMinLenResult);
	}

	if (checkRequiredResult !==undefined&&checkRequiredResult?.length > 0) {
		errs.push(checkRequiredResult);
	}

	return errs;
};

export const checkPassword=(password:string)=>{
 let errs:string[]=[];

	const checkMaxLenResult=checkMaxLen(password);
	const checkMinLenResult=checkMinLen(password);
	const checkRequiredResult=checkRequired(password);

	// if(checkMaxLenResult?.length>0){
	// 	errs.push(checkMaxLenResult);
	// }

	// if(checkMinLenResult?.length>0){
	// 	errs.push(checkMinLenResult);
	// }

	// if(checkRequiredResult?.length>0){
	// 	errs.push(checkRequiredResult);
	// }

	if (checkMaxLenResult!==undefined&&checkMaxLenResult.length > 0) {
		errs.push(checkMaxLenResult);
	}

	if (checkMinLenResult!==undefined&&checkMinLenResult.length > 0) {
		errs.push(checkMinLenResult);
	}

	if (checkRequiredResult!==undefined&&checkRequiredResult.length > 0) {
		errs.push(checkRequiredResult);
	}
	return errs;
}

export const checkName=(name:string)=>{
	let errs:string[]=[];

	const checkMaxLenResult=checkMaxLen(name);

	// if(checkMaxLenResult?.length>0){
	// 	errs.push(checkMaxLenResult);
	// }

	if (checkMaxLenResult!==undefined&&checkMaxLenResult.length > 0) {
		errs.push(checkMaxLenResult);
	}
	return errs;
};


export const checkPhoto = (photo: any) => {
	console.log('checkPhoto');
	let errs:string[]=[];
	const checkValidPhotoResult=checkValidPhoto(photo);
	// if(checkValidPhotoResult?.length>0){
	// 	errs.push(checkValidPhotoResult);
	// }

	if (checkValidPhotoResult !== undefined && checkValidPhotoResult.length > 0) {
		console.log('checkphoto error');
		errs.push(checkValidPhotoResult);
	}
	return errs;
};

export const checkComments=(comment:string)=>{
	let errs:string[]=[];

	const checkMaxLenResult=checkMaxLen(comment);

	// if(checkMaxLenResult?.length>0){
	// 	errs.push(checkMaxLenResult);
	// }

	if (checkMaxLenResult!==undefined&&checkMaxLenResult.length > 0) {
		errs.push(checkMaxLenResult);
	}

	return errs;
};

export const checkTodo=(todo:string)=>{
	let errs:string[]=[];

	const checkMaxLenResult=checkMaxLen(todo);
	const checkRequiredResult=checkRequired(todo);

	// if(checkRequiredResult?.length>0){
	// 	errs.push(checkRequiredResult);
	// }

	if (checkRequiredResult!==undefined&&checkRequiredResult?.length>0){
		errs.push(checkRequiredResult);
	}

	// if(checkMaxLenResult?.length>0){
	// 	errs.push(checkMaxLenResult);
	// }

	if(checkMaxLenResult!==undefined&&checkMaxLenResult?.length>0){
		errs.push(checkMaxLenResult);
	}

	return errs;
};
