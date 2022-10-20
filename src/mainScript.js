import { imagePath } from '@nextcloud/router'
import { loadState } from '@nextcloud/initial-state'

function main() {
	// we get the data injected via the Initial State mechanism
	const state = loadState('tutorial_2', 'tutorial_initial_state')
	const fileNameList = state.file_name_list

	// this is the empty div from the template (/templates/myMainTemplate.php)
	const tutorialDiv = document.querySelector('#app-content #tutorial_2')

	// for each file, we create a div which contains a button and an image
	fileNameList.forEach(name => {
		console.debug('iii', imagePath('tutorial_2', 'gifs/' + name))
		const fileDiv = document.createElement('div')
		fileDiv.classList.add('gif-wrapper')

		const img = document.createElement('img')
		img.setAttribute('src', imagePath('tutorial_2', 'gifs/' + name))
		img.style.display = 'none'

		// the button toggles the image visibility
		const button = document.createElement('button')
		button.innerText = 'Show/hide ' + name
		button.addEventListener('click', (e) => {
			if (img.style.display === 'block') {
				img.style.display = 'none'
			} else {
				img.style.display = 'block'
			}
		})

		fileDiv.append(button)
		fileDiv.append(img)
		tutorialDiv.append(fileDiv)
	})
}

// we wait for the page to be fully loaded
document.addEventListener('DOMContentLoaded', (event) => {
	main()
})
