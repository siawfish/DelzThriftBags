import React, { Component } from 'react'
import { connect } from 'react-redux'
import { editAccount } from './redux/actions';

export class EditAccount extends Component {

    handleOnSubmit = (event)=>{
        event.preventDefault();
        let updatedAccount = {
            id:this.props.match.params.id,
            accountName: event.target.elements.accountName.value,
            accountNumber: event.target.elements.accountNumber.value,
            bankName: event.target.elements.bankName.value,
            bankBranch: event.target.elements.bankBranch.value,
        }
        this.props.editAccount(updatedAccount)
        this.props.history.push("/")
    }



    render() {
        let id = this.props.match.params.id;
        let account  = this.props.accounts.find((item)=>{
            return item.id===id
        })
        return (
            <div>
                <h1>Edit Account</h1>
               <form onSubmit={this.handleOnSubmit}>
                   <div>
                       <label>Account Name</label>
                       <input type="text" name="accountName" defaultValue={account.accountName}/>
                   </div>

                   <div>
                   <label>Account Number</label>
                       <input type="number" name="accountNumber" defaultValue={account.accountNumber}/>
                   </div>

                   <div>
                        <label>Bank Name</label>
                       <input type="text" name="bankName" defaultValue={account.bankName}/>
                   </div>

                   <div>
                        <label>Bank Branch</label>
                       <input type="text" name="bankBranch" defaultValue={account.bankBranch}/>
                   </div>

                   <div>
                       <button type="submit">Update Account</button>
                   </div>
                </form> 
            </div>
        )
    }
}


const mapStateToProps = (state)=>{
    return {
        accounts:state.accounts
    }
}



export default connect(mapStateToProps, {editAccount})(EditAccount)