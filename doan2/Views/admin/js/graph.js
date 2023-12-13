	function graph() {
		let ctx = document.querySelector("#revenueChart");
		ctx.height = 150;

		let revChart = new Chart(ctx, {
			type: "line",
			data: {
				labels: ["June 1", "June 3", "June 6", "June 9", "June 12", "June 15", "June 18", "June 21", "June 14", "June 27", "June 30"],
				datasets: [
					{
						label: "Views",
						borderColor: "#DD2F6E",
						borderWidth: "3",
						backgroundColor: "rgba(235, 247, 245, 0.5)",
						data: [0, 50, 25, 1000, 20, 80, 30, 55, 20, 60, 40]
					}
				]
			},
			options: {
				responsive: true,
				tooltips: {
					intersect: false,
					node: "index",
				}
			}
		});	

	}
