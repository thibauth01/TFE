import React from 'react'
import { StyleSheet,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input} from 'galio-framework'
import { theme } from '../Constants';
import { connect } from 'react-redux'

import DashboardWorker from "./DashboardWorker"
import DashboardRequester from "./DashboardRequester"




class Dashboard extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      
    }
  }
  

  dashboardType = () => {
    if(this.props.account.type == "requester"){
        return <DashboardRequester navigate = {this.props.navigation}/>
    }
    else if(this.props.account.type == "worker"){
        return <DashboardWorker navigate =  {this.props.navigation}/>
    }
    else{
        return <Text>hello</Text>
    }
}


  render() {
    
    return (
        <Block middle  style={styles.main_container}>
            {this.dashboardType()}
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

const mapStateToProps = (state) =>{
  return {
      account: state.account.account
  }
}

export default connect(mapStateToProps)(Dashboard)