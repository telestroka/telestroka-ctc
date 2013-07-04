function feedback_check(form)
{
    if ( !is_right_length(form.text.value,1,2000) ) return(set_error(form.text, errors['1-2000']));
    if ( !is_right_length(form.name.value,0,255) ) return(set_error(form.name, errors['0-255']));
    if ( !is_email(form.email.value)&& !is_empty(form.email.value) ) return(set_error(form.email, errors['email']));
	if ( !is_right_length(form.city.value,0,255) ) return(set_error(form.city, errors['0-255']));
	if ( !is_right_length(form.company.value,0,255) ) return(set_error(form.company, errors['0-255']));
}