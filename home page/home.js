//Get current date
const date = new Date();

const renderCalendar=()=>{
    //Get calendar year
    const calendarYear = date.getFullYear();

    //Get current month
    const monthIndex = date.getMonth();
    const months= ["January","February","March","April","May","June","July",
                "August","September","October","November","December"];
    const month = months[monthIndex]
    
    //Find current month end date
    const lastDay = new Date(date.getFullYear(),
    date.getMonth() + 1, 0).getDate()

    //Find current month start day index
    const firstDayIndex = new Date(date.getFullYear(), 
    date.getMonth(), 1).getDay();

    //Find prev month end date
    const prevLastDate = new Date(date.getFullYear(),
    date.getMonth(), 0).getDate()

    //Find current month end day index
    const lastDayIndex = new Date(date.getFullYear(),
    date.getMonth() + 1, 0).getDay()

    //Print month and year to html
    document.querySelector(".date h3").innerHTML = month + " " + date.getFullYear();

    //Days of the month
    const monthDays = document.querySelector(".days")
    let days = '';

    //Add prev month days to calendar
    for(let x = firstDayIndex; x > 0; x--){
        days += `<div class="prev-date">${prevLastDate-x+1}</div>`;
    }

    // const d_initial_date = "<?php echo $d_initial_date?>";  //Retrieve the date of the last time the user had bubble tea
    // const m_initial_date = "<?php echo $m_initial_date?>";  //Retrieve the month of the last time the user had bubble tea
    // const Y_initial_date = "<?php echo $Y_initial_date?>";  //Retrieve the year of the last time the user had bubble tea
    const d_next_date = "<?php echo $d_next_date?>";  //Retrieve the day of the next time the user had bubble tea
    const m_next_date = "<?php echo $m_next_date?>";  //Retrieve the month of the next time the user had bubble tea
    const Y_next_date = "<?php echo $Y_next_date?>";  //Retrieve the year of the next time the user had bubble tea

    //Add the dates in the current month
    for(let i=1; i<=lastDay; i++){          // This is for highlighting current date
        if(i == new Date().getDate() &&    // checks that the date is equal to today's date
        monthIndex == new Date().getMonth()){   // checks that the month is equal to today's month
            days += `<div class="today">${i}</div>`;
        }else if(i == d_next_date &&    // checks that the date is equal to next bubble tea date
        monthIndex ==  m_next_date - 1 &&
        calendarYear == Y_next_date){
            days += `<img src="../images/PinClipart.com_catering-clip-art_5398038.png"
            alt="bubble tea" class="bubble-tea-date">`;
        }else{
            days += `<div>${i}</div>`;
        }
    }

    //Add dates of next month to calendar
    for(let j = 1; j < 7-lastDayIndex; j++){
        days += `<div class="next-date">${j}</div>`
    }
    monthDays.innerHTML = days;
}

//********The following is for making the arrows work ********
// Adding click event listener to prev arrow 
document.querySelector('.prev-arrow').
addEventListener('click', ()=>{
    date.setMonth(date.getMonth() - 1, 1)
    renderCalendar()
})

// Adding click event listener to next arrow
document.querySelector('.next-arrow').
addEventListener('click', ()=>{
    date.setMonth(date.getMonth() + 1, 1)
    renderCalendar()
})

renderCalendar()