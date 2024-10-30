/*window.addEventListener("load", function() {

	// store tabs variables
	var tabs = document.querySelectorAll("ul.nav-tabs > li");

	for (i = 0; i < tabs.length; i++) {
		tabs[i].addEventListener("click", switchTab);
	}

	function switchTab(event) {
		event.preventDefault();

		document.querySelector("ul.nav-tabs li.active").classList.remove("active");
		document.querySelector(".tab-pane.active").classList.remove("active");

		var clickedTab = event.currentTarget;
		var anchor = event.target;
		var activePaneID = anchor.getAttribute("href");

		clickedTab.classList.add("active");
		document.querySelector(activePaneID).classList.add("active");

	}

});*/



jQuery(document).ready(function($) {

        /*get selected option*/

        $("#lcp_bg_option").change(function () {

            if ($(this).val() == "i") {

                $("#lcp_background_img").show();
                $("#lcp_background_clr").hide();

            } else if ( $ (this).val() == "c") {

            	$("#lcp_background_img").hide();
                $("#lcp_background_clr").show();

            }

            else{ }

        });

    });


jQuery(document).ready(function($) {

	var image_custom_uploader;

	jQuery("#lcp_logo").on("click", function(){

	var image_custom_uploader = wp.media({

		title: "Upload Image",
		multiple: false
		}).open().on("select", function(e) {

			var attachment = image_custom_uploader.state().get("selection").first().toJSON();


			 var url = '';
			 url = attachment['url'];

			 jQuery('#image_url').val(url);

			 jQuery('#preview').attr("src", url);

			 
			});
		});
	});

jQuery(document).ready(function($) {

	var image_custom_uploader;

	jQuery("#lcp_bgimg").on("click", function(){

	var image_custom_uploader = wp.media({

		title: "Upload Image",
		multiple: false
		}).open().on("select", function(e) {

			var attachment = image_custom_uploader.state().get("selection").first().toJSON();


			 var url = '';
			 url = attachment['url'];

			 jQuery('#bgimage_url').val(url);

			  jQuery('#bgpreview').attr("src", url);

			});
		});
	});


