
//is_done:any->because the value passed from blade is 1 or 0. Convert them into string in php by wrapping '', and cast them to boolean in JavaScript.
export const onHandleIsDone=($todo_id:number,route:string)=>{
	console.log('onHandleIsDone');
	console.log($todo_id);

		document.querySelector<any>("#check_todo_id").value = $todo_id;
		document.querySelector<any>("#todo_form").action = `/todo-list/is-done/${$todo_id}`;
		document.querySelector<any>("#todo_form").method = 'post';
		// document.querySelector<any>("#hidden_method_for_check_todo_id").value='patch';
		document.querySelector<any>("#todo_form").submit();
};

export const onStartEditMode=(todo_id:number,prev_title:string,is_done:any)=>{
	console.log('onStartEditMode');
	console.log(todo_id);
	console.log(prev_title);
	console.log(is_done);

  is_done==='1'?true:false;
	document.querySelector<any>(`#todo_display_${todo_id}`).addEventListener('click',(e:any)=>{
		 document.querySelector<any>(`#todo_display_${todo_id}`).outerHTML=`<input id=todo_title_${todo_id} class="" name="title" type="text" onChange="onChangeTitle(${todo_id})" onBlur={onEndEditMode(${todo_id},'${prev_title}',${is_done})} onKeydown=onSubmitTitle(${todo_id},'${prev_title}',${is_done})>`;
	});

};

export const onEndEditMode=(todo_id:number,prev_title:string,is_done:any)=>{
	console.log('onEndEditMode');
	console.log(todo_id);
	console.log(prev_title);
	console.log(is_done);

  is_done==='1'?true:false;
	document.querySelector<any>(`#todo_title_${todo_id}`).addEventListener('blur',(e:any)=>{
			document.querySelector<any>(`#todo_title_${todo_id}`).outerHTML=`<p id="todo_display_${todo_id}" class="${is_done?'textdecoration-linethrough':''}" onClick="onStartEditMode(${todo_id},'${prev_title}',${is_done})">${prev_title}</p>`;
	});
};
export const onChangeTitle=(todo_id:number)=>{
	console.log('onChangeTitle');
	console.log(todo_id);

	document.querySelector<any>(`#todo_title_${todo_id}`).addEventListener('change',(e:any)=>{
			document.querySelector<any>(`#todo_title_${todo_id}`).value=e.target.value;
	});
};

export const onSubmitTitle=(todo_id:number,prev_title:string,is_done:any)=>{
	console.log('onSubmit');
	console.log(todo_id);
	console.log(prev_title);
	console.log(is_done);

  is_done==='1'?true:false;
	document.querySelector<any>(`#todo_title_${todo_id}`).addEventListener('keydown',(e:any)=>{
		if(e.keyCode===13){
		 if(e.target.value.length===0||e.target.value===prev_title){
			document.querySelector<any>(`#todo_title_${todo_id}`).outerHTML=`<p id="todo_display_${todo_id}" class="${is_done?'textdecoration-linethrough':''}" onClick="onStartEditMode(${todo_id},'${prev_title}',${is_done})">${prev_title}</p>`;

		 }else{
			document.querySelector<any>("#todo_title_form").method="post";
	  	document.querySelector<any>("#todo_title_form").action=`/todo-list/update-title/${todo_id}`;//Not working?
		  document.querySelector<any>("#todo_title_form").submit();
		 }

		 }
	});
};
