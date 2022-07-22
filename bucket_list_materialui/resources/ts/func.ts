
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
	// document.querySelector<any>(`#todo_display_${todo_id}`).outerHTML=`<input id=todo_title_${todo_id} class="" name="title" type="text" onblur={onEndEditMode(${todo_id},'${prev_title}',${is_done})} onKeydown="(e)=>onSubmitTitle(${todo_id},'${prev_title}',${is_done},e)">`;
	document.querySelector<any>(`#todo_display_${todo_id}`).outerHTML=`<input id=todo_title_${todo_id} class="" name="title" type="text" onblur="onEndEditMode(${todo_id},'${prev_title}',${is_done})">`;

};

export const onEndEditMode=(todo_id:number,prev_title:string,is_done:any)=>{
	console.log('onEndEditMode');

	is_done==='1'?true:false;
	document.querySelector<any>(`#todo_title_${todo_id}`).outerHTML=`<p id="todo_display_${todo_id}" class="${is_done?'textdecoration-linethrough':''}" onclick="onStartEditMode(${todo_id},'${prev_title}',${is_done})">${prev_title}</p>`;
};

export const onChangeTitle=(todo_id:number)=>{
	console.log('onChangeTitle');

	document.querySelector<any>(`#todo_title_${todo_id}`).addEventListener('change',(e:any)=>{
			document.querySelector<any>(`#todo_title_${todo_id}`).value=e.target.value;
	});
};

export const onSubmitTitle=(todo_id:number,prev_title:string,is_done:any)=>{
	console.log('onSubmit');
  console.log('enter pressed!');

	is_done==='1'?true:false;
	const $todo_title_form_element=document.querySelector<any>("#todo_title_form");

		 if($todo_title_form_element.value.length===0||$todo_title_form_element.value===prev_title){
			console.log('$todo_title_form_element.value:'+$todo_title_form_element.value);
			console.log('$todo_title_form_element.value.length:'+$todo_title_form_element.value.length);
			console.log('prev.title===$todo_title_form_element.value:'+$todo_title_form_element.value===prev_title);

			document.querySelector<any>(`#todo_title_${todo_id}`).outerHTML=`<p id="todo_display_${todo_id}" class="${is_done?'textdecoration-linethrough':''}" onclick="onStartEditMode(${todo_id},'${prev_title}','${is_done}')">${prev_title}</p>`;

		 }else{

			$todo_title_form_element.method="post";
			$todo_title_form_element.action=`/todo-list/update-title/${todo_id}`;//Not working?
			$todo_title_form_element.submit();
		 }

};
