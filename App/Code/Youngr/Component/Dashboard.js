import React from 'react'
import { StyleSheet,Image,View,Platform,SafeAreaView, ImageBackground,Linking } from 'react-native'
import {Button,Text, Block, Input,Icon} from 'galio-framework'
import { theme } from '../Constants';
import { connect } from 'react-redux'
import NetInfo from '@react-native-community/netinfo'


import DashboardWorker from "./DashboardWorker"
import DashboardRequester from "./DashboardRequester"

function  Offline() {
  return (
    <Block flex={1} middle row>
      <Icon  size={40} name="wifi-off" family="feather"/>
      <Text h5 style={{marginLeft:15}}>Aucune connexion internet</Text>
    </Block>
  );
}


class Dashboard extends React.Component {

  constructor(props) {
    super(props)
    this.state = {
      isConnected:false
    }
  }
  
  componentDidMount(){
    NetInfo.addEventListener(this.handleConnectivityChange);
  }

  componentWillUnmount() {
    NetInfo.addEventListener(this.handleConnectivityChange);
  }

  handleConnectivityChange = state => {
    if (state.isConnected) {
      this.setState({isConnected: true});
    } else {
      this.setState({isConnected: false});
    }
  };

  dashboardType = () => {
    
    
    if(this.props.account.type == "requester"){
      return <DashboardRequester connected = {this.state.isConnected} navigate = {this.props.navigation}/>
    }
    else if(this.props.account.type == "worker"){
        return <DashboardWorker connected = {this.state.isConnected} navigate =  {this.props.navigation}/>
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