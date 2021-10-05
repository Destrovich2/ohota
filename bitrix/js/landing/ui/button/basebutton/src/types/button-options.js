interface BaseButtonOptions
{
	id?: string;
	text?: string;
	html?: string;
	onClick?: () => void;
	attrs?: {[key: string]: any};
	disabled?: boolean;
	className?: string | Array<string>;
	active?: boolean;
}

export default BaseButtonOptions;