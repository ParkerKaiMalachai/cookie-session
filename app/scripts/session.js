let startBtn = document.querySelector(".session-create-btn")
let destroyBtn = document.querySelector(".session-destroy-btn")

startBtn
	? startBtn.addEventListener("click", async (e) => {
			e.preventDefault()

			let name = e.target
				.closest(".session-create-form")
				.querySelector(".session-create-name").value
			let action = "startSession"

			try {
				const response = await fetch("index.php", {
					method: "POST",
					headers: {
						"Content-Type": "application/x-www-form-urlencoded",
					},
					body: new URLSearchParams({ name, action }),
				})

				if (response.ok) {
					const data = await response.text()

					const newWindow = window.open()

					newWindow.document.write(data)

					newWindow.document.close()
				} else {
					const error = await response.json()
				}
			} catch (e) {}
	  })
	: ""

destroyBtn
	? destroyBtn.addEventListener("click", async (e) => {
			e.preventDefault()

			let action = "destroySession"

			try {
				const response = await fetch("index.php", {
					method: "POST",
					headers: {
						"Content-Type": "application/x-www-form-urlencoded",
					},
					body: new URLSearchParams({ action }),
				})
			} catch (e) {}
	  })
	: ""
