<table {%attributes%} >
<tr><th>id</th>
<th>name</th>
<th>username</th>
<th>password</th>
<tr>
<? foreach($this->getWidgets() as $widget){
			if(! $widget instanceof APushButton)echo $widget->render();
		}?>
		<tr>
		<td>{prevButton}</td>
		<td>{nextButton}</td>
		</tr>
		</table>