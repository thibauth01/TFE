import moment from 'moment'
import React from "react";
import {ActivityIndicator} from 'react-native'
import {theme} from './index'

export function getAge(birthDate) {
    var birthday = new Date(birthDate);
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
}

export function reformatDate(date){
    const newDate = new Date(date);
    const month = Number(newDate.getMonth()) + 1 
    return newDate.getDate() + "/" + month + "/" + newDate.getFullYear()
}

export function reformatTime(time){
    return time.slice(0,5);
}

export function getPrice(time_start,time_end,priceHour){
    const dtStart = new Date("01/01/2000 " + time_start);
    const dtEnd = new Date("01/01/2000 " + time_end);
    const diff = Math.abs(dtEnd - dtStart);
    const minutes = Math.floor((diff/1000)/60);
    const price =  minutes * (Number(priceHour)/60);
    return price.toFixed(2);
   

}

export function loading(){
    return(
        <ActivityIndicator size="small" color={theme.COLORS.MUTED}/>
    )
}

export function isNotTooLongText(text,lengthMax){
    return(
        ((text).length > lengthMax) ? 
        (((text).substring(0,lengthMax-3)) + ' ...') : 
        text
    )

}

export const mois = ["janv", "fev", "mars", "avril", "mai", "juin",
                        "juil", "aout", "sept", "oct", "nov", "dec"
                    ];