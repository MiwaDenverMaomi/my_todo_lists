
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