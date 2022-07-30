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

export const onHandleSelectPhoto=(photo:string|null)=>{
	const sizeLimit=2560*1920*1;
	const $inputPhoto=document.querySelector<any>('#input_photo');
	const $photoFrame=document.querySelector<any>('#photo_frame');
	const photos=$inputPhoto.files!==null?$inputPhoto.files:[
		'./img/no_image.jpg'
	];
	if(photo!==null){
		const $photo_err_element=document.querySelector<any>('#photo_err');
		let photoErrMsgs:string[]=checkPhoto(photo);
		photos.map((item:string)=>{
		if(photoErrMsgs.length>0){
			$inputPhoto.value='';
			$photo_err_element.innerText=photoErrMsgs[0];
		}else{
			$photoFrame.innerHTML=`<img src="${item}" alt="${name===null?'No name':name}">`;
			$photo_err_element.innerText='';
			photoErrMsgs=[];
		}
	});
	}
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

export const onSubmitProfile=(user_id:number)=>{
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
		$photo_err_element.innerHTML=errMsgs.photo[1];
		$name_err_element.innerHTML=errMsgs.name[1];
		$comment1_err_element.innerHTML=errMsgs.comment1[1];
		$comment2_err_element.innerHTML=errMsgs.comment2[1];
		$comment3_err_element.innerHTML=errMsgs.comment3[1];

	}else{
		const $profile_form_element=document.querySelector<any>('#profile_form');
		errMsgs={
			email:[],
			name:[],
			photo:[],
			comment1:[],
			comment2:[],
			comment3:[],
		};

		$profile_form_element.method="post";
		$profile_form_element.action=`"/${user_id}/edit-profile"`;
		$profile_form_element.submit();
	}
};

export const onToggleLike=async(is_liked_by_auth:boolean,user:number)=>{
	console.log('onToggleLike');
  let result:any=await axios.post(`/user/store-like/`,{
		params:{
			to_user:user,
			is_liked_by_auth:is_liked_by_auth
		}
	}).then((res:any)=>res).catch((err:any)=>err);
	console.log(result);

	if(result.data.is_liked_by_auth.length>0){
		const is_liked_by_auth=result.data.is_liked_by_auth;
    const $heart_element=document.querySelector<any>(`#like-id_${user}`);
		$heart_element.className+=is_liked_by_auth===true?'active':'';
    return;
	}else if(result.data.storeLike_error.length>0){

	}else if(result.data.errors.length>0){

	}else{

	}
}
export const onToggleFavorite=(is_liked_by_auth:boolean)=>{
	console.log('onToggleFavorite');

  let result:any=axios.get('/store-favorite',{
		params:{
			to_user:!is_liked_by_auth
		}
	}).then((res:any)=>res).catch((err:any)=>err);

  console.log(result);

	if(result.data.is_success===true){
		return {
			is_sucess:true,
			result:result.data
		}
	}else if(result===undefined){
		return {
			is_success:false,
			result:'Failed to favorite. Try again later.'
		}
	}else if(result.data.errors.length>0){
		return {
			is_success:false,
			result:result.data.errors
		}
	}else if(result.data.is_success===false){
		return {
			is_success:false,
			result:result.data.errors.storeFavorite_error
		}
	}

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

//validation
export const checkRequired=(str:string)=>{
	if(str.length===0){
		return 'Input required.';
	}else{
		return '';
	}
};

export const checkMinLen=(str:string,num:number=7)=>{
	if(str.length<num){
		return `Input more than ${num} letters.`;
	}else{
		return '';
	}
};

export const checkMaxLen=(str:string,num:number=255)=>{
	if(str.length>num){
		return `Input less than ${num} letters.`;
	}else{
		return '';
	}
};

export const checkValidEmail=(email:string)=>{
	const pattern = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/;
	if(!pattern.test(email)){
		return 'Input valid email address.'
	}else{
		return '';
	}
};

export const checkValidPhoto=(photo:any,sizeLimit:number=2560*1920*1,mb:number=5)=>{
	if(photo.size>sizeLimit){
		return `Upload less than ${mb} MB.`;
	}else{
		return '';
	}
};

export const checkEmail=(email:string)=>{
	let errs:string[]=[];
	const checkValidEmailResult=checkValidEmail(email);
	const checkMaxLenResult=checkMaxLen(email);
	const checkMinLenResult=checkMinLen(email);
	const checkRequiredResult=checkRequired(email);

	if(checkValidEmailResult?.length>0){
		errs.push(checkValidEmailResult);
	}

	if(checkMaxLenResult?.length>0){
		errs.push(checkMaxLenResult);
	}

	if(checkMinLenResult?.length>0){
		errs.push(checkMinLenResult);
	}

	if(checkRequiredResult?.length>0){
		errs.push(checkRequiredResult);
	}

	return errs;
};

export const checkPassword=(password:string)=>{
 let errs:string[]=[];

	const checkMaxLenResult=checkMaxLen(password);
	const checkMinLenResult=checkMinLen(password);
	const checkRequiredResult=checkRequired(password);

	if(checkMaxLenResult?.length>0){
		errs.push(checkMaxLenResult);
	}

	if(checkMinLenResult?.length>0){
		errs.push(checkMinLenResult);
	}

	if(checkRequiredResult?.length>0){
		errs.push(checkRequiredResult);
	}

	return errs;
}

export const checkName=(name:string)=>{
	let errs:string[]=[];

	const checkMaxLenResult=checkMaxLen(name);

	if(checkMaxLenResult?.length>0){
		errs.push(checkMaxLenResult);
	}
	return errs;
};


export const checkPhoto=(photo:string)=>{
	let errs:string[]=[];
	const checkValidPhotoResult=checkValidPhoto(photo);
	if(checkValidPhotoResult?.length>0){
		errs.push(checkValidPhotoResult);
	}
	return errs;
};

export const checkComments=(comment:string)=>{
	let errs:string[]=[];

	const checkMaxLenResult=checkMaxLen(comment);

	if(checkMaxLenResult?.length>0){
		errs.push(checkMaxLenResult);
	}

	return errs;
};

export const checkTodo=(todo:string)=>{
	let errs:string[]=[];

	const checkMaxLenResult=checkMaxLen(todo);
	const checkRequiredResult=checkRequired(todo);

	if(checkMaxLenResult?.length>0){
		errs.push(checkMaxLenResult);
	}

	if(checkRequiredResult?.length>0){
		errs.push(checkRequiredResult);
	}

	return errs;
};
