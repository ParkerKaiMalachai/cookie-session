let startBtn = document.querySelector(".session-create-btn")
let dataBlock = document.querySelector(".session-data")

startBtn
	? startBtn.addEventListener("click", async (e) => {
			e.preventDefault()

			let name = e.target
				.closest(".session-create-form")
				.querySelector(".session-create-name").value
			let action = "startSession"

			try {
				const response = await fetch("tasks/session.php", {
					method: "POST",
					headers: {
						"Content-Type": "application/x-www-form-urlencoded",
					},
					body: new URLSearchParams({ name, action }),
				})

				if (response.ok) {
					const data = await response.json()
				} else {
					const error = await response.json()
				}
			} catch (e) {}
			setTimeout(() => {
				window.location.reload()
			}, 1000)
	  })
	: ""

window.addEventListener("click", async (e) => {
	if (e.target.classList.contains("session-destroy-btn")) {
		e.preventDefault()

		let action = "destroySession"

		try {
			const response = await fetch("tasks/session.php", {
				method: "POST",
				headers: {
					"Content-Type": "application/x-www-form-urlencoded",
				},
				body: new URLSearchParams({ action }),
			})
		} catch (e) {}

		dataBlock.innerHTML = ""

		setTimeout(() => {
			window.location.reload()
		}, 1000)
	}
})
