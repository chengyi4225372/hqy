import React from 'react'
import UserContext from '../context/UserContext'
import TestConsumer from './TextConsumer'
class TestUserContext extends React.Component {
  render() {
    return (
      <UserContext.Consumer>
        {value =>(
          <h1>{value.userinfo.name}</h1>
        )}
      </UserContext.Consumer>
    );
  }
}

export default TestUserContext;

