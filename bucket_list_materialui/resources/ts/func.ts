
export const onHandleIsDone=($todo_id:number,route:string)=>{
	console.log('onHandleIsDone');
	console.log($todo_id);
	console.log(route);

		document.querySelector<any>("#check_todo_id").value = $todo_id;
    document.querySelector<any>("#todo_form").action = `{{ route(${route},$todo_id) }}`;
		document.querySelector<any>("#todo_form").method = 'post';
	  document.querySelector<any>("#todo_form").submit();
};
