<?php 

/**
 * This Component class will act as email class till email class is finished
 * in the framework.
 *	
 * @author Ephigenia // Marcel Eichner <love@ephigenia.de>
 * @since 20.05.2009
 * @package harrison
 * @subpackage harrison.lib.component
 */
class ViewMailer extends AppComponent
{	
	/**
	 * 	Default mail headers set
	 * 	@var Hash
	 */
	public $headers;

	/**
	 * 	Default mail subject
	 * 	@var string
	 */
	public $subject = AppController::NAME;
	
	/**
	 * 	Name of directory to search for views
	 * 	@var string
	 */
	public $viewDir = 'email';
	
	public function startup()
	{
		$this->headers = new Hash(array(
			'Reply-To' => Registry::get('AdminEmail'),
			'From' => Registry::get('AdminEmail'),
		));
		return parent::startup();
	}
	
	/**
	 * 	Send email $to with using the $template file in the
	 * 	/app/view/email/ directory otherwise you changed {@link $viewDir}
	 * 	@param $to
	 * 	@param string			$template	Filename of template to use
	 * 	@param string			$subject		Optional alternate subject that should be used
	 * 	@param array(string)	$data		optional additional associated array data to render in the view
	 * 	@return boolean	true if mail was successfully send, otherwise false
	 */
	public function send($to, $template, $subject = null, $data = array())
	{
		// use user logged in email for reply adress
		if ($this->controller->UserLogin->loggedin()) {
			$this->headers->set('Reply-To', $this->controller->UserLogin->User->get('email'));
			$this->headers->set('From', $this->controller->UserLogin->User->get('email'));
		}
		// render content
		$view = Library::create('ephFrame.lib.view.View', array($this->viewDir, $template, array_merge($this->controller->data->toArray(), $data)));
		$view->theme = $this->controller->theme;
		// send mail and return result
		return @mail(
			$to,
			$subject == null ? $this->subject : $subject,
			$view->render(),
			$this->headers->implodef(RTLF, '%s: %s')
		);
	}	
}