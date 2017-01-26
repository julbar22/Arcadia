function cambiarimagen(){
  //  var a=document.form1.Icono.value;
  var a= $("#Icono").val();
  console.log(a);
	document.images['avatar'].src=a;
}
