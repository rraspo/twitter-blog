import axios from 'axios'
import React, { Component } from 'react'
import ReactDOM from 'react-dom'

class TwitterTimeline extends Component {

    constructor(props) {
        super(props)
        let content = JSON.parse(props.user)
        console.log(content)
        this.state = {
            user: content,
            tweets: []
        };
    }

    componentDidMount() {
        var self = this
        let user_id = this.state.user.id
        axios.get('/api/users/' + user_id + '/tweets')
            .then(function (response) {
                self.setState({
                    tweets: response.data
                })
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            })
    }

    render() {
        this.tweets = this.state.tweets.map((tweet, key) =>
            <li className="list-group-item tweet" key={tweet.id || key}>
                {tweet.text || tweet.message + " Not in Twitter."}
            </li>
        )
        return (
            <div className="row justify-content-center">
                <div className="col-md-12">
                    <div className="card twitter-container">
                        <div className="card-header twitter-card">
                            <i className="fab fa-twitter-square"></i>&nbsp;Tweets by @{this.state.user.twitter_username}
                        </div>
                        <ul className="list-group">
                            {this.tweets}
                        </ul>
                    </div>
                </div>
            </div>
        )
    }
}

export default TwitterTimeline;

if (document.getElementById('twitter-timeline')) {
    const el = document.getElementById('twitter-timeline')
    const props = Object.assign({}, el.dataset)
    console.log(props)
    ReactDOM.render(<TwitterTimeline {...props} />, document.getElementById('twitter-timeline'));
}
