import React from "react";
import { View, Image,StyleSheet, TouchableOpacity, Dimensions } from "react-native";
import { Block,Text } from "galio-framework";
import { theme } from '../Constants';
import {getAge,reformatDate,reformatTime,getPrice,mois,isNotTooLongText} from '../Constants/Utils'



export default class CardWorkNotAttributed extends React.Component { 

  constructor(props){
    super(props);
    this.state={
        maxCharTitle:30
    }
  }
    getStatut(date){
        const dateMoment = new Date(date);
        const now = new Date();
        const dat1 = dateMoment.getFullYear() + dateMoment.getMonth() + dateMoment.getDate();
        const dat2 = now.getFullYear() + now.getMonth() + now.getDate();

        if(dat1 >= dat2){
            const month = Number(dateMoment.getMonth()) + 1 
          return (
            <Text muted>{dateMoment.getDate() + "/" + month + "/" + dateMoment.getFullYear()}</Text> 
          )
        }
        else{
            return (
                <Text color={theme.COLORS.ERROR}>dépassé</Text> 
              )
        }
      }

    render() { 
        const {navigate} = this.props.navigate
        const statut = this.getStatut(this.props.item.date_start)
      return (
        <TouchableOpacity
            onPress={() => navigate('DetailsWorkFree',this.props.item)}>
            <Block flex={1} style={styles.block_main} height={70} row middle>
                <Block style={{marginLeft:20}} flex={2}>
                    <Text size={16}>{isNotTooLongText(this.props.item.title,this.state.maxCharTitle)}</Text>
                </Block>
                <Block flex={2}>
                    <Text size={13} color={theme.COLORS.SECONDARY}>{this.props.item.type}</Text>
                </Block>
                <Block flex={1.2} style={{marginRight:10}} right>
                    {statut}
                </Block>
            </Block>
        </TouchableOpacity>
         
      );
    }
  }

  const styles = StyleSheet.create({
    block_main:{
        width:Dimensions.get("window").width -10,
        backgroundColor:theme.COLORS.DEFAULT,
        marginTop:5,
        marginBottom:5,
        borderRadius:10,
        shadowColor: "#000",
        shadowOffset: {
          width: 0,
          height: 2,
        },
        shadowOpacity: 0.23,
        shadowRadius: 2.62,

        elevation: 4,
    },
    profile: {
        width:65,
        height:65,
        borderRadius:10,
        marginLeft:3
    },
  
  
  })