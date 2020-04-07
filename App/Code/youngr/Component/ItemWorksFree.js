import React from 'react'
import { StyleSheet,Image,View,Platform,TouchableOpacity,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input,Card} from 'galio-framework'
import { theme } from '../Constants';


class ItemWorksFree extends React.Component {

  constructor(props) {
    super(props)
    this.state = {

    }
  }


  render() {
    const {navigate} = this.props.navigate
    const title = this.props.title;
    const type = this.props.type;
    const date = this.props.date;
    const path_profile = this.props.path_profile;
    console.log(path_profile);
    return (
      <Block style={styles.itemWorksFree}>
        <TouchableOpacity
          onPress={() => navigate('DetailsWork',{title:title,type:type,date:date,path_profile:path_profile})}>
          <Card
            borderless
            style={styles.cardWorksFree}
            title={title}
            caption={type}
            captionColor={theme.COLORS.SECONDARY}
            location={date}
            avatar={path_profile}
          />
      </TouchableOpacity>
    </Block>
        
    )
  }
}

const styles = StyleSheet.create({

  main_container: {
    flex:1,
    backgroundColor:theme.COLORS.BACKGROUND
    
  },
  itemWorksFree:{
    marginBottom:5,
    backgroundColor:"white"
  },
  cardWorksFree:{
    shadowColor: "#000",
    shadowOffset: {
        width: 0,
        height: 1,
    },
    shadowOpacity: 0.20,
    shadowRadius: 1.41,

    elevation: 2,
    height:70
  }

})

export default ItemWorksFree