
	function toastSuccess(message) {
	    toastr.success(message, '', { "positionClass": "toast-top-full-width" });
	}

	function toastWarning(message) {
	    toastr.warning(message, '', { "positionClass": "toast-top-full-width" });
	}

	function toastError(message) {
	    toastr.error(message, '', { "positionClass": "toast-top-full-width" });
	}

	function removeUnicode(str) {

	    str = str.toLowerCase();
	    str = str.replace(/Ă |Ă¡|áº¡|áº£|Ă£|Ă¢|áº§|áº¥|áº­|áº©|áº«|Äƒ|áº±|áº¯|áº·|áº³|áºµ/g, "a");
	    str = str.replace(/Ă¨|Ă©|áº¹|áº»|áº½|Ăª|á»|áº¿|á»‡|á»ƒ|á»…/g, "e");
	    str = str.replace(/Ă¬|Ă­|á»‹|á»‰|Ä©/g, "i");
	    str = str.replace(/Ă²|Ă³|á»|á»|Ăµ|Ă´|á»“|á»‘|á»™|á»•|á»—|Æ¡|á»|á»›|á»£|á»Ÿ|á»¡/g, "o");
	    str = str.replace(/Ă¹|Ăº|á»¥|á»§|Å©|Æ°|á»«|á»©|á»±|á»­|á»¯/g, "u");
	    str = str.replace(/á»³|Ă½|á»µ|á»·|á»¹/g, "y");
	    str = str.replace(/Ä‘/g, "d");
	    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_|â€“|â€|â€œ|`/g, "-");

	    str = str.replace(/-+-/g, "-");
	    str = str.replace(/^\-+|\-+$/g, "");

	    return str;
	}

	function dayOfYear() {
	    var now = new Date();
	    var start = new Date(now.getFullYear(), 0, 0);
	    var diff = now - start;
	    var oneDay = 1000 * 60 * 60 * 24;
	    var day = Math.floor(diff / oneDay);
	    return day;
	}