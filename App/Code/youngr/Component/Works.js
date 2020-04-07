import React from 'react'
import { StyleSheet,Dimensions,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input} from 'galio-framework'
import { theme } from '../Constants';



class Works extends React.Component {

  constructor(props) {
    super(props)
    this.state = {

    }
  }


  render() {
    
    
    return (
        <Block top  style={styles.main_container}>
          
        </Block>
    )
  }
}

const styles = StyleSheet.create({

  main_container: {
    flex:1,
    backgroundColor:theme.COLORS.BACKGROUND
    
  }
})

export default Works