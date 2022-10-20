import { generateOcsUrl, generateUrl } from '@nextcloud/router'
import { dirname } from '@nextcloud/paths'
import { showError } from '@nextcloud/dialogs'
import { loadState } from '@nextcloud/initial-state'
import '../css/main.scss'

function main() {
	const state = loadState('tutorial_2', 'tutorial_initial_state')
	console.debug('[tutorial_2] state', state)
}

document.addEventListener('DOMContentLoaded', (event) => {
	main()
})
