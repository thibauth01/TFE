import React from 'react'
import { StyleSheet } from 'react-native'
import {Button,Text, Block, Input} from 'galio-framework'
import { theme } from '../Constants';
import { connect } from 'react-redux'

import MyAccountWorker from './MyAccountWorker';
import MyAccountRequester from './MyAccountRequester';



class MyAccount extends React.Component {

  constructor(props) {
    super(props)
    this.state = {

    }
  }

  accountType = () => {
    if(this.props.account.type == "requester"){
        return <MyAccountRequester navigate = {this.props.navigation}/>
    }
    else if(this.props.account.type == "worker"){
        return <MyAccountWorker navigate =  {this.props.navigation}/>
    }
    else{
        return <Text>hello</Text>
    }
}


  render() {
    
    
    return (
        <Block   style={styles.main_container}>
          {this.accountType()}
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

export default connect(mapStateToProps)(MyAccount)