import React from 'react'
import { StyleSheet,Dimensions,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input} from 'galio-framework'
import { theme } from '../Constants';
import { connect } from 'react-redux'

import WorksRequester from './WorksRequester';
import WorksWorker from './WorksWorker';



class Works extends React.Component {

  constructor(props) {
    super(props)
    this.state = {

    }
  }

  worksType = () => {
    if(this.props.account.type == "requester"){
        return <WorksRequester navigate = {this.props.navigation}/>
    }
    else if(this.props.account.type == "worker"){
        return <WorksWorker navigate =  {this.props.navigation}/>
    }
    else{
        return <Text>hello</Text>
    }
}


  render() {
    
    
    return (
        <Block   style={styles.main_container}>
          {this.worksType()}
        </Block>
    )
  }
}

const styles = StyleSheet.create({

  main_container: {
    flex:1,
    backgroundColor:theme.COLORS.BACKGROUND,
    
  }
})

const mapStateToProps = (state) =>{
  return {
      account: state.account.account
  }
}

export default connect(mapStateToProps)(Works)