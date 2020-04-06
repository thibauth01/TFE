import React from 'react'
import { StyleSheet,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input} from 'galio-framework'
import { theme } from '../Constants';


class Message extends React.Component {

  constructor(props) {
    super(props)
    this.state = {

    }
  }


  render() {
   
    return (
        <Block middle  style={styles.main_container}>
            <Text>Hello message</Text>
        </Block>
    )
  }
}

const styles = StyleSheet.create({

  main_container: {
    flex:1,
    backgroundColor:theme.COLORS.BACKGROUND
    
  },

})

export default Message