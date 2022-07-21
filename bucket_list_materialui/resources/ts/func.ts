
export const onHandleIsDone=($todo_id:number,route:string)=>{
	console.log('onHandleIsDone');
	console.log($todo_id);

		document.querySelector<any>("#check_todo_id").value = $todo_id;
    document.querySelector<any>("#todo_form").action = `/todo-list/is-done/${$todo_id}`;
		document.querySelector<any>("#todo_form").method = 'post';
		// document.querySelector<any>("#hidden_method_for_check_todo_id").value='patch';
	  document.querySelector<any>("#todo_form").submit();
};

export const onHandleEditMode=(todo_id:number)=>{
	console.log('onHandleEditMode');
	console.log(todo_id);
	document.querySelector<any>("#todo_display").innerHTML=`<input id=${todo_id}_title class="" type="text" valule="" onChange="onChangeTitle(e)"  ondblclick=onSubmitTitle(e)>`
};

export const onChangeTitle=(e:any)=>{
	document.querySelector<any>(e.target.id).value=e.target.value;
};

export const onSubmitTitle=(e:any)=>{
	if(e.keyCode==='13'){
		document.querySelector<any>("#todo_title_form").method="post";
		document.querySelector<any>("#todo_title_form").action=`todo-list/update-title/${e.target.id.replace('_title','')}`;
		document.querySelector<any>("#todo_title_form").submit();
	}
};
