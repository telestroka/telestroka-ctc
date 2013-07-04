function smi_check(form)
{
    if ( !is_right_length(form.name.value,1,255) ) return(set_error(form.name, errors['1-255']));
    if ( !is_right_length(form.title.value,1,255) ) return(set_error(form.title, errors['1-255']));
    if ( !is_right_length(form.circulation.value,1,255) ) return(set_error(form.circulation, errors['1-255']));
    if ( !is_right_length(form.pages.value,1,255) ) return(set_error(form.pages, errors['1-255']));
    if ( !is_right_length(form.format.value,1,255) ) return(set_error(form.format, errors['1-255']));
    if ( !is_right_length(form.publish_day.value,1,255) ) return(set_error(form.publish_day, errors['1-255']));
    if ( !is_right_length(form.price_list.value,1,10000) ) return(set_error(form.price_list, errors['1-2000']));
}

function smi_city_check(form)
{
	if ( !is_right_length(form.title.value,1,255) ) return(set_error(form.title, errors['1-255']));
}

function smi_sect_check(form)
{
	if ( !is_right_length(form.title.value,1,255) ) return(set_error(form.title, errors['1-255']));
}
