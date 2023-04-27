import { Controller } from '@hotwired/stimulus';
import axios from 'axios'

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    static values = {
        infoUrl: String
    }
    async play(evt) {
        evt.preventDefault()

        const { data: { url }} = await axios.get(this.infoUrlValue)
        console.log(url)
        const audio = new Audio(url)
        audio.play()
    }
}
