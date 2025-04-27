function convertPersianNumbersToEnglish(input) {  
    const persianToEnglish = {  
        '۰': '0',  
        '۱': '1',  
        '۲': '2',  
        '۳': '3',  
        '۴': '4',  
        '۵': '5',  
        '۶': '6',  
        '۷': '7',  
        '۸': '8',  
        '۹': '9'  
    };  
    return input.replace(/[۰-۹]/g, char => persianToEnglish[char]);  
}  

function jalali_to_gregorian(jy, jm, jd) {  
    let gy = (jy > 979) ? 1600 : 621;  
    jy -= (jy > 979) ? 979 : 0;  
    let days = (365 * jy) + Math.floor(jy / 33) * 8 + Math.floor((jy % 33 + 3) / 4) + 78 + jd + ((jm < 7) ? (jm - 1) * 31 : ((jm - 7) * 30) + 186);  
    gy += Math.floor(days / 146097) * 400;  
    days %= 146097;  
    if (days > 36524) {  
        gy += Math.floor(--days / 36524) * 100;  
        days %= 36524;  
        if (days >= 365) days++;  
    }  
    gy += Math.floor(days / 1461) * 4;  
    days %= 1461;  
    gy += Math.floor((days - 1) / 365);  
    days = (days > 0) ? (days - 1) % 365 : 0;  
    let gm = (days < 186) ? 1 + Math.floor(days / 31) : 7 + Math.floor((days - 186) / 30);  
    let gd = 1 + ((days < 186) ? (days % 31) : ((days - 186) % 30));  
    return [gy, gm, gd];  
}  

function validateDateFormat(dateString) {  
    // Check if the date string matches the format YYYY/MM/DD  
    const regex = /^\d{4}\/\d{1,2}\/\d{1,2}$/;  
    return regex.test(dateString);  
}  

function calculateAge(dob, isPersian) {  
    let birthDate;  

    if (isPersian) {  
        dob = convertPersianNumbersToEnglish(dob); // Convert Persian numbers to English  

        // Validate the Jalali date format  
        if (!validateDateFormat(dob)) {  
            console.error("Invalid date format. Expected format: YYYY/MM/DD");  
            return NaN; // Return NaN to indicate an error  
        }  

        const jalaliDate = dob.split('/').map(Number);  
        if (jalaliDate.some(isNaN)) {  
            console.error("Invalid Jalali date values");  
            return NaN; // Return NaN to indicate an error  
        }  

        const gregorianDate = jalali_to_gregorian(jalaliDate[0], jalaliDate[1], jalaliDate[2]);  
        birthDate = new Date(gregorianDate[0], gregorianDate[1] - 1, gregorianDate[2]);  
    } else {  
        // Expecting a date in YYYY-MM-DD format for the HTML input type="date"  
        birthDate = new Date(dob);  
    }  

    const currentDate = new Date();  
    let age = currentDate.getFullYear() - birthDate.getFullYear();  
    const monthDiff = currentDate.getMonth() - birthDate.getMonth();  
    if (monthDiff < 0 || (monthDiff === 0 && currentDate.getDate() < birthDate.getDate())) {  
        age--;  
    }  

    return age;  
}  

// Fade-in and slide-in effect for this page  
        $(document).ready(function () {  
            $(".login-container").css({   
                top: '50%', // Move to center position  
                opacity: '1' // Fade in   
            });  

            // Also fade in the body  
            $("body").animate({ opacity: 1 }, 3000); // Animate body fade-in effect  
        });  