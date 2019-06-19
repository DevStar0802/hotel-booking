export function formatDate(date) {

  if(typeof date === 'string'){
    var d = new Date(date);
  } else var d = date;

    var
        month = '' + (d.getUTCMonth() + 1),
        day = '' + d.getUTCDate(),
        year = d.getUTCFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
export function diffDates(date1, date2){
  let diffTime = Math.abs(date2.getTime() - date1.getTime());
  let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
  return diffDays;
}
