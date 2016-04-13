<section class="wrapper">
<nav role="navigation" class="navbar navbar-inverse">
<div class="navbar-header">
                              <a href="#" class="navbar-brand">Tin tức</a>
                          </div>
<form role="form" class="form-inline navbar-right" method="get" action="">
                                  <div class="form-group">
                                      <input type="text" name="from" placeholder="Từ ngày" class="form-control input-sm date-picker search-input">
                                  </div>
                                  <div class="form-group">
                                      <input type="text" name="to" placeholder="Tới ngày" class="form-control input-sm date-picker search-input">
                                  </div>

                                  <div class="form-group">
                                      <input type="text" name="keyword" placeholder="Từ khóa"  class="form-control input-sm search-input">
                                  </div>
                                  <button class="btn btn-success input-sm" type="submit">Tìm</button>
 </form>
</nav>
 <!-- page start-->



<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Thêm mới bài viết
                          </header>
                          <div class="panel-body">
                              <form method="get" class="form-horizontal tasi-form">
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Tiêu đề</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="title" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Help text</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control">
                                          <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Rounder</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control round-input">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Input focus</label>
                                      <div class="col-sm-10">
                                          <input type="text" value="This is focused..." id="focusedInput" class="form-control">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Disabled</label>
                                      <div class="col-sm-10">
                                          <input type="text" disabled="" placeholder="Disabled input here..." id="disabledInput" class="form-control">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Placeholder</label>
                                      <div class="col-sm-10">
                                          <input type="text" placeholder="placeholder" class="form-control">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Password</label>
                                      <div class="col-sm-10">
                                          <input type="password" placeholder="" class="form-control">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 col-sm-2 control-label">Static control</label>
                                      <div class="col-lg-10">
                                          <p class="form-control-static">email@example.com</p>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                      <section class="panel">
                          <div class="panel-body">
                              <form method="get" class="form-horizontal tasi-form">
                                  <div class="form-group has-success">
                                      <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Input with success</label>
                                      <div class="col-lg-10">
                                          <input type="text" id="inputSuccess" class="form-control">
                                      </div>
                                  </div>
                                  <div class="form-group has-warning">
                                      <label for="inputWarning" class="col-sm-2 control-label col-lg-2">Input with warning</label>
                                      <div class="col-lg-10">
                                          <input type="text" id="inputWarning" class="form-control">
                                      </div>
                                  </div>
                                  <div class="form-group has-error">
                                      <label for="inputError" class="col-sm-2 control-label col-lg-2">Input with error</label>
                                      <div class="col-lg-10">
                                          <input type="text" id="inputError" class="form-control">
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                      <section class="panel">
                          <div class="panel-body">
                              <form method="get" class="form-horizontal tasi-form">
                                  <div class="form-group">
                                      <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Control sizing</label>
                                      <div class="col-lg-10">
                                          <input type="text" placeholder=".input-lg" class="form-control input-lg m-bot15">
                                          <input type="text" placeholder="Default input" class="form-control m-bot15">
                                          <input type="text" placeholder=".input-sm" class="form-control input-sm m-bot15">

                                          <select class="form-control input-lg m-bot15">
                                              <option>Option 1</option>
                                              <option>Option 2</option>
                                              <option>Option 3</option>
                                          </select>
                                          <select class="form-control m-bot15">
                                              <option>Option 1</option>
                                              <option>Option 2</option>
                                              <option>Option 3</option>
                                          </select>
                                          <select class="form-control input-sm m-bot15">
                                              <option>Option 1</option>
                                              <option>Option 2</option>
                                              <option>Option 3</option>
                                          </select>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                      <section class="panel">
                          <div class="panel-body">
                              <form method="get" class="form-horizontal tasi-form">
                                  <div class="form-group">
                                      <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Checkboxes and radios</label>
                                      <div class="col-lg-10">
                                          <div class="checkbox">
                                              <label>
                                                  <input type="checkbox" value="">
                                                  Option one is this and that&mdash;be sure to include why it's great
                                              </label>
                                          </div>

                                          <div class="checkbox">
                                              <label>
                                                  <input type="checkbox" value="">
                                                  Option one is this and that&mdash;be sure to include why it's great option one
                                              </label>
                                          </div>

                                          <div class="radio">
                                              <label>
                                                  <input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios">
                                                  Option one is this and that&mdash;be sure to include why it's great
                                              </label>
                                          </div>
                                          <div class="radio">
                                              <label>
                                                  <input type="radio" value="option2" id="optionsRadios2" name="optionsRadios">
                                                  Option two can be something else and selecting it will deselect option one
                                              </label>
                                          </div>

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Inline checkboxes</label>
                                      <div class="col-lg-10">
                                          <label class="checkbox-inline">
                                              <input type="checkbox" value="option1" id="inlineCheckbox1"> 1
                                          </label>
                                          <label class="checkbox-inline">
                                              <input type="checkbox" value="option2" id="inlineCheckbox2"> 2
                                          </label>
                                          <label class="checkbox-inline">
                                              <input type="checkbox" value="option3" id="inlineCheckbox3"> 3
                                          </label>

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Selects</label>
                                      <div class="col-lg-10">
                                          <select class="form-control m-bot15">
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                          </select>

                                          <select class="form-control" multiple="">
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Column sizing</label>
                                      <div class="col-lg-10">
                                          <div class="row">
                                              <div class="col-lg-2">
                                                  <input type="text" placeholder=".col-lg-2" class="form-control">
                                              </div>
                                              <div class="col-lg-3">
                                                  <input type="text" placeholder=".col-lg-3" class="form-control">
                                              </div>
                                              <div class="col-lg-4">
                                                  <input type="text" placeholder=".col-lg-4" class="form-control">
                                              </div>
                                          </div>

                                      </div>
                                  </div>

                              </form>
                          </div>
                      </section>

                      <section class="panel">
                          <header class="panel-heading">
                              Input groups
                          </header>
                          <div class="panel-body">
                              <form method="get" class="form-horizontal tasi-form">
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2">Basic examples</label>
                                      <div class="col-lg-10">
                                          <div class="input-group m-bot15">
                                              <span class="input-group-addon">@</span>
                                              <input type="text" placeholder="Username" class="form-control">
                                          </div>

                                          <div class="input-group m-bot15">
                                              <input type="text" class="form-control">
                                              <span class="input-group-addon">.00</span>
                                          </div>

                                          <div class="input-group m-bot15">
                                              <span class="input-group-addon">$</span>
                                              <input type="text" class="form-control">
                                              <span class="input-group-addon">.00</span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2">Sizing</label>
                                      <div class="col-lg-10">
                                          <div class="input-group input-group-lg m-bot15">
                                              <span class="input-group-addon">@</span>
                                              <input type="text" placeholder="Username" class="form-control input-lg">
                                          </div>

                                          <div class="input-group m-bot15">
                                              <span class="input-group-addon">@</span>
                                              <input type="text" placeholder="Username" class="form-control">
                                          </div>

                                          <div class="input-group input-group-sm m-bot15">
                                              <span class="input-group-addon">@</span>
                                              <input type="text" placeholder="Username" class="form-control">
                                          </div>

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2">Checkboxe and radio</label>
                                      <div class="col-lg-10">
                                          <div class="input-group m-bot15">
                                              <span class="input-group-addon">
                                                <input type="checkbox">
                                              </span>
                                              <input type="text" class="form-control">
                                          </div>

                                          <div class="input-group m-bot15">
                                              <span class="input-group-addon">
                                                <input type="radio">
                                              </span>
                                              <input type="text" class="form-control">
                                          </div>

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2">Button addons</label>
                                      <div class="col-lg-10">
                                          <div class="input-group m-bot15">
                                              <span class="input-group-btn">
                                                <button type="button" class="btn btn-white">Go!</button>
                                              </span>
                                              <input type="text" class="form-control">
                                          </div>

                                          <div class="input-group m-bot15">
                                              <input type="text" class="form-control">
                                              <span class="input-group-btn">
                                                <button type="button" class="btn btn-white">Go!</button>
                                              </span>
                                          </div>

                                          <div class="input-group m-bot15">
                                              <div class="input-group-btn">
                                                  <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">Action <span class="caret"></span></button>
                                                  <ul class="dropdown-menu">
                                                      <li><a href="#">Action</a></li>
                                                      <li><a href="#">Another action</a></li>
                                                      <li><a href="#">Something else here</a></li>
                                                      <li class="divider"></li>
                                                      <li><a href="#">Separated link</a></li>
                                                  </ul>
                                              </div>
                                              <input type="text" class="form-control">
                                          </div>
                                          <div class="input-group m-bot15">
                                              <input type="text" class="form-control">
                                              <div class="input-group-btn">
                                                  <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">Action <span class="caret"></span></button>
                                                  <ul class="dropdown-menu pull-right">
                                                      <li><a href="#">Action</a></li>
                                                      <li><a href="#">Another action</a></li>
                                                      <li><a href="#">Something else here</a></li>
                                                      <li class="divider"></li>
                                                      <li><a href="#">Separated link</a></li>
                                                  </ul>
                                              </div>
                                          </div>

                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2">Segmented buttons</label>
                                      <div class="col-lg-10">
                                          <div class="input-group m-bot15">
                                              <div class="input-group-btn">
                                                  <button type="button" class="btn btn-white" tabindex="-1">Action</button>
                                                  <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                                                      <span class="caret"></span>
                                                  </button>
                                                  <ul class="dropdown-menu" role="menu">
                                                      <li><a href="#">Action</a></li>
                                                      <li><a href="#">Another action</a></li>
                                                      <li><a href="#">Something else here</a></li>
                                                      <li class="divider"></li>
                                                      <li><a href="#">Separated link</a></li>
                                                  </ul>
                                              </div>
                                              <input type="text" class="form-control">
                                          </div>

                                          <div class="input-group m-bot15">
                                              <input type="text" class="form-control">
                                              <div class="input-group-btn">
                                                  <button type="button" class="btn btn-white" tabindex="-1">Action</button>
                                                  <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown" tabindex="-1">
                                                      <span class="caret"></span>
                                                  </button>
                                                  <ul class="dropdown-menu pull-right" role="menu">
                                                      <li><a href="#">Action</a></li>
                                                      <li><a href="#">Another action</a></li>
                                                      <li><a href="#">Something else here</a></li>
                                                      <li class="divider"></li>
                                                      <li><a href="#">Separated link</a></li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                              </form>
                          </div>
                      </section>

                      <div class="row">
                          <div class="col-lg-6">
                              <section class="panel">
                                  <header class="panel-heading">
                                      Switch
                                  </header>
                                  <div class="panel-body">
                                      <div class="row m-bot15">
                                          <div class="col-sm-6 text-center">
                                              <div class="switch has-switch"><div class="switch-animate switch-on"><input type="checkbox" data-toggle="switch" checked=""><span class="switch-left">ON</span><label>&nbsp;</label><span class="switch-right">OFF</span></div></div>
                                          </div>
                                          <div class="col-sm-6 text-center">
                                              <div class="switch has-switch"><div class="switch-animate switch-off"><input type="checkbox" data-toggle="switch"><span class="switch-left">ON</span><label>&nbsp;</label><span class="switch-right">OFF</span></div></div>
                                          </div>
                                      </div>
                                      <div class="row m-bot15">
                                          <div class="col-sm-6 text-center">
                                              <div data-off-label="&lt;i class='icon-remove'&gt;&lt;/i&gt;" data-on-label="&lt;i class=' icon-ok'&gt;&lt;/i&gt;" class="switch switch-square has-switch">
                                                  <div class="switch-animate switch-off"><input type="checkbox"><span class="switch-left"><i class=" icon-ok"></i></span><label>&nbsp;</label><span class="switch-right"><i class="icon-remove"></i></span></div>
                                              </div>
                                          </div>
                                          <div class="col-sm-6 text-center">
                                              <div data-off-label="&lt;i class='icon-remove'&gt;&lt;/i&gt;" data-on-label="&lt;i class=' icon-ok'&gt;&lt;/i&gt;" class="switch switch-square has-switch">
                                                  <div class="switch-animate switch-on"><input type="checkbox" checked=""><span class="switch-left"><i class=" icon-ok"></i></span><label>&nbsp;</label><span class="switch-right"><i class="icon-remove"></i></span></div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-sm-6 text-center">
                                              <div class="switch has-switch deactivate"><div class="switch-animate switch-off"><input type="checkbox" data-toggle="switch" disabled=""><span class="switch-left">ON</span><label>&nbsp;</label><span class="switch-right">OFF</span></div></div>
                                          </div>
                                          <div class="col-sm-6 text-center">
                                              <div class="switch has-switch deactivate"><div class="switch-animate switch-on"><input type="checkbox" data-toggle="switch" disabled="" checked=""><span class="switch-left">ON</span><label>&nbsp;</label><span class="switch-right">OFF</span></div></div>
                                          </div>
                                      </div>
                                  </div>
                              </section>
                              <section class="panel">
                                  <header class="panel-heading">
                                      Tags Input
                                  </header>
                                  <div class="panel-body">
                                      <input value="Flat,Design,Lab,Clean" class="tagsinput" id="tagsinput" name="tagsinput" style="display: none;"><div class="tagsinput " id="tagsinput_tagsinput" style="height: 100%;"><span class="tag"><span>Flat&nbsp;&nbsp;</span><a class="tagsinput-remove-link"></a></span><span class="tag"><span>Design&nbsp;&nbsp;</span><a class="tagsinput-remove-link"></a></span><span class="tag"><span>Lab&nbsp;&nbsp;</span><a class="tagsinput-remove-link"></a></span><span class="tag"><span>Clean&nbsp;&nbsp;</span><a class="tagsinput-remove-link"></a></span><div id="tagsinput_addTag" class="tagsinput-add-container"><div class="tagsinput-add"></div><input data-default="" value="" id="tagsinput_tag" style="color: rgb(102, 102, 102); width: 7px;"></div></div>
                                  </div>
                              </section>
                          </div>
                          <div class="col-lg-6">
                              <section class="panel">
                                  <header class="panel-heading">
                                      Custom Checkbox &amp; Radio
                                  </header>
                                  <div class="panel-body">
                                      <form accept-charset="utf-8" method="get" action="#">
                                          <div class="checkboxes">
                                              <label for="checkbox-01" class="label_check c_on">
                                                  <input type="checkbox" checked="" value="1" id="checkbox-01" name="sample-checkbox-01"> I agree to the terms &amp; conditions.
                                              </label>
                                              <label for="checkbox-02" class="label_check c_off">
                                              <input type="checkbox" value="1" id="checkbox-02" name="sample-checkbox-02"> Please send me regular updates. </label>
                                              <label for="checkbox-03" class="label_check c_off">
                                              <input type="checkbox" value="1" id="checkbox-03" name="sample-checkbox-02"> This is nice checkbox.</label>

                                          </div>
                                          <div class="radios">
                                              <label for="radio-01" class="label_radio r_on">
                                                  <input type="radio" checked="" value="1" id="radio-01" name="sample-radio"> This is option A...
                                              </label>
                                              <label for="radio-02" class="label_radio r_off">
                                                  <input type="radio" value="1" id="radio-02" name="sample-radio"> and this is option B...
                                              </label>
                                              <label for="radio-03" class="label_radio r_off">
                                                  <input type="radio" value="1" id="radio-03" name="sample-radio"> or simply choose option C
                                              </label>
                                          </div>
                                      </form>
                                  </div>

                              </section>

                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-12">
                              <section class="panel">
                                  <header class="panel-heading">
                                      Masked inputs
                                  </header>
                                  <div class="panel-body">
                                      <form class="form-horizontal" action="#">
                                          <div class="form-group">
                                              <label class="col-sm-2 col-sm-2 control-label">ISBN 1</label>
                                              <div class="col-sm-10">
                                                  <input type="text" class="form-control" data-mask="999-99-999-9999-9" placeholder="">
                                                  <span class="help-inline">999-99-999-9999-9</span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-sm-2 control-label">ISBN 2</label>
                                              <div class="col-sm-10">
                                                  <input type="text" class="form-control" data-mask="999 99 999 9999 9" placeholder="">
                                                  <span class="help-inline">999 99 999 9999 9</span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-sm-2 control-label">ISBN 3</label>
                                              <div class="col-sm-10">
                                                  <input type="text" class="form-control" data-mask="999/99/999/9999/9" placeholder="">
                                                  <span class="help-inline">999/99/999/9999/9</span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-sm-2 control-label">IPV4</label>
                                              <div class="col-sm-10">
                                                  <input type="text" class="form-control" data-mask="999.999.999.9999" placeholder="">
                                                  <span class="help-inline">192.168.110.310</span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-sm-2 control-label">IPV6</label>
                                              <div class="col-sm-10">
                                                  <input type="text" class="form-control" data-mask="9999:9999:9999:9:999:9999:9999:9999" placeholder="">
                                                  <span class="help-inline">4deg:1340:6547:2:540:h8je:ve73:98pd</span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-sm-2 control-label">Tax ID</label>
                                              <div class="col-sm-10">
                                                  <input type="text" class="form-control" data-mask="99-9999999" placeholder="">
                                                  <span class="help-inline">99-9999999</span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-sm-2 control-label">Phone</label>
                                              <div class="col-sm-10">
                                                  <input type="text" class="form-control" data-mask="(999) 999-9999" placeholder="">
                                                  <span class="help-inline">(999) 999-9999</span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-sm-2 control-label">Currency</label>
                                              <div class="col-sm-10">
                                                  <input type="text" class="form-control" data-mask="$ 999,999,999.99" placeholder="">
                                                  <span class="help-inline">$ 999,999,999.99</span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-sm-2 control-label">Date</label>
                                              <div class="col-sm-10">
                                                  <input type="text" class="form-control" data-mask="99/99/9999" placeholder="">
                                                  <span class="help-inline">dd/mm/yyyy</span>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="col-sm-2 control-label">Date 2</label>
                                              <div class="col-sm-10">
                                                  <input type="text" class="form-control" data-mask="99-99-9999" placeholder="">
                                                  <span class="help-inline">dd-mm-yyyy</span>
                                              </div>
                                          </div>

                                      </form>
                                  </div>
                              </section>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-12">
                              <section class="panel">
                                  <header class="panel-heading">
                                      CKEditor
                                  </header>
                                  <div class="panel-body">
                                      <div class="form">
                                          <form class="form-horizontal" action="#">
                                              <div class="form-group">
                                                  <label class="col-sm-2 control-label col-sm-2">CKEditor</label>
                                                  <div class="col-sm-10">
                                                      <textarea rows="6" name="editor1" class="form-control ckeditor" style="visibility: hidden; display: none;"></textarea><div lang="en" aria-labelledby="cke_editor1_arialbl" role="application" dir="ltr" class="cke_1 cke cke_reset cke_chrome cke_editor_editor1 cke_ltr cke_browser_gecko" id="cke_editor1"><span class="cke_voice_label" id="cke_editor1_arialbl">Rich Text Editor</span><div role="presentation" class="cke_inner cke_reset"><span style="height: auto; -moz-user-select: none;" role="presentation" class="cke_top cke_reset_all" id="cke_1_top"><span class="cke_voice_label" id="cke_4">Editor toolbars</span><span onmousedown="return false;" aria-labelledby="cke_4" role="group" class="cke_toolbox" id="cke_1_toolbox"><span role="toolbar" aria-labelledby="cke_5_label" class="cke_toolbar" id="cke_5"><span class="cke_voice_label" id="cke_5_label">Clipboard/Undo</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><a onclick="CKEDITOR.tools.callFunction(7,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(6,event);" onfocus="return CKEDITOR.tools.callFunction(5,event);" onkeydown="return CKEDITOR.tools.callFunction(4,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_6_label" role="button" hidefocus="true" tabindex="-1" title="Cut" class="cke_button cke_button__cut  cke_button_disabled" id="cke_6" aria-disabled="true"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -352px;" class="cke_button_icon cke_button__cut_icon">&nbsp;</span><span class="cke_button_label cke_button__cut_label" id="cke_6_label">Cut</span></a><a onclick="CKEDITOR.tools.callFunction(11,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(10,event);" onfocus="return CKEDITOR.tools.callFunction(9,event);" onkeydown="return CKEDITOR.tools.callFunction(8,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_7_label" role="button" hidefocus="true" tabindex="-1" title="Copy" class="cke_button cke_button__copy  cke_button_disabled" id="cke_7" aria-disabled="true"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -288px;" class="cke_button_icon cke_button__copy_icon">&nbsp;</span><span class="cke_button_label cke_button__copy_label" id="cke_7_label">Copy</span></a><a onclick="CKEDITOR.tools.callFunction(15,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(14,event);" onfocus="return CKEDITOR.tools.callFunction(13,event);" onkeydown="return CKEDITOR.tools.callFunction(12,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_8_label" role="button" hidefocus="true" tabindex="-1" title="Paste" class="cke_button cke_button__paste cke_button_off " id="cke_8"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -416px;" class="cke_button_icon cke_button__paste_icon">&nbsp;</span><span class="cke_button_label cke_button__paste_label" id="cke_8_label">Paste</span></a><a onclick="CKEDITOR.tools.callFunction(19,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(18,event);" onfocus="return CKEDITOR.tools.callFunction(17,event);" onkeydown="return CKEDITOR.tools.callFunction(16,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_9_label" role="button" hidefocus="true" tabindex="-1" title="Paste as plain text" class="cke_button cke_button__pastetext cke_button_off " id="cke_9"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -960px;" class="cke_button_icon cke_button__pastetext_icon">&nbsp;</span><span class="cke_button_label cke_button__pastetext_label" id="cke_9_label">Paste as plain text</span></a><a onclick="CKEDITOR.tools.callFunction(23,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(22,event);" onfocus="return CKEDITOR.tools.callFunction(21,event);" onkeydown="return CKEDITOR.tools.callFunction(20,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_10_label" role="button" hidefocus="true" tabindex="-1" title="Paste from Word" class="cke_button cke_button__pastefromword cke_button_off " id="cke_10"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -1024px;" class="cke_button_icon cke_button__pastefromword_icon">&nbsp;</span><span class="cke_button_label cke_button__pastefromword_label" id="cke_10_label">Paste from Word</span></a><span role="separator" class="cke_toolbar_separator"></span><a onclick="CKEDITOR.tools.callFunction(27,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(26,event);" onfocus="return CKEDITOR.tools.callFunction(25,event);" onkeydown="return CKEDITOR.tools.callFunction(24,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_11_label" role="button" hidefocus="true" tabindex="-1" title="Undo" class="cke_button cke_button__undo cke_button_disabled" id="cke_11" aria-disabled="true"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -1344px;" class="cke_button_icon cke_button__undo_icon">&nbsp;</span><span class="cke_button_label cke_button__undo_label" id="cke_11_label">Undo</span></a><a onclick="CKEDITOR.tools.callFunction(31,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(30,event);" onfocus="return CKEDITOR.tools.callFunction(29,event);" onkeydown="return CKEDITOR.tools.callFunction(28,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_12_label" role="button" hidefocus="true" tabindex="-1" title="Redo" class="cke_button cke_button__redo cke_button_disabled" id="cke_12" aria-disabled="true"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -1280px;" class="cke_button_icon cke_button__redo_icon">&nbsp;</span><span class="cke_button_label cke_button__redo_label" id="cke_12_label">Redo</span></a></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_13_label" class="cke_toolbar" id="cke_13"><span class="cke_voice_label" id="cke_13_label">Editing</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><a onclick="CKEDITOR.tools.callFunction(35,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(34,event);" onfocus="return CKEDITOR.tools.callFunction(33,event);" onkeydown="return CKEDITOR.tools.callFunction(32,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="true" aria-labelledby="cke_14_label" role="button" hidefocus="true" tabindex="-1" title="Spell Check As You Type" class="cke_button cke_button__scayt cke_button_off " id="cke_14"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -1184px;" class="cke_button_icon cke_button__scayt_icon">&nbsp;</span><span class="cke_button_label cke_button__scayt_label" id="cke_14_label">Spell Check As You Type</span><span class="cke_button_arrow"></span></a></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_15_label" class="cke_toolbar" id="cke_15"><span class="cke_voice_label" id="cke_15_label">Links</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><a onclick="CKEDITOR.tools.callFunction(39,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(38,event);" onfocus="return CKEDITOR.tools.callFunction(37,event);" onkeydown="return CKEDITOR.tools.callFunction(36,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_16_label" role="button" hidefocus="true" tabindex="-1" title="Link" class="cke_button cke_button__link cke_button_off " id="cke_16"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -832px;" class="cke_button_icon cke_button__link_icon">&nbsp;</span><span class="cke_button_label cke_button__link_label" id="cke_16_label">Link</span></a><a onclick="CKEDITOR.tools.callFunction(43,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(42,event);" onfocus="return CKEDITOR.tools.callFunction(41,event);" onkeydown="return CKEDITOR.tools.callFunction(40,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_17_label" role="button" hidefocus="true" tabindex="-1" title="Unlink" class="cke_button cke_button__unlink cke_button_disabled" id="cke_17" aria-disabled="true"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -864px;" class="cke_button_icon cke_button__unlink_icon">&nbsp;</span><span class="cke_button_label cke_button__unlink_label" id="cke_17_label">Unlink</span></a><a onclick="CKEDITOR.tools.callFunction(47,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(46,event);" onfocus="return CKEDITOR.tools.callFunction(45,event);" onkeydown="return CKEDITOR.tools.callFunction(44,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_18_label" role="button" hidefocus="true" tabindex="-1" title="Anchor" class="cke_button cke_button__anchor cke_button_off " id="cke_18"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -800px;" class="cke_button_icon cke_button__anchor_icon">&nbsp;</span><span class="cke_button_label cke_button__anchor_label" id="cke_18_label">Anchor</span></a></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_19_label" class="cke_toolbar" id="cke_19"><span class="cke_voice_label" id="cke_19_label">Insert</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><a onclick="CKEDITOR.tools.callFunction(51,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(50,event);" onfocus="return CKEDITOR.tools.callFunction(49,event);" onkeydown="return CKEDITOR.tools.callFunction(48,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_20_label" role="button" hidefocus="true" tabindex="-1" title="Image" class="cke_button cke_button__image cke_button_off " id="cke_20"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -736px;" class="cke_button_icon cke_button__image_icon">&nbsp;</span><span class="cke_button_label cke_button__image_label" id="cke_20_label">Image</span></a><a onclick="CKEDITOR.tools.callFunction(55,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(54,event);" onfocus="return CKEDITOR.tools.callFunction(53,event);" onkeydown="return CKEDITOR.tools.callFunction(52,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_21_label" role="button" hidefocus="true" tabindex="-1" title="Table" class="cke_button cke_button__table cke_button_off " id="cke_21"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -1216px;" class="cke_button_icon cke_button__table_icon">&nbsp;</span><span class="cke_button_label cke_button__table_label" id="cke_21_label">Table</span></a><a onclick="CKEDITOR.tools.callFunction(59,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(58,event);" onfocus="return CKEDITOR.tools.callFunction(57,event);" onkeydown="return CKEDITOR.tools.callFunction(56,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_22_label" role="button" hidefocus="true" tabindex="-1" title="Insert Horizontal Line" class="cke_button cke_button__horizontalrule cke_button_off " id="cke_22"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -704px;" class="cke_button_icon cke_button__horizontalrule_icon">&nbsp;</span><span class="cke_button_label cke_button__horizontalrule_label" id="cke_22_label">Insert Horizontal Line</span></a><a onclick="CKEDITOR.tools.callFunction(63,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(62,event);" onfocus="return CKEDITOR.tools.callFunction(61,event);" onkeydown="return CKEDITOR.tools.callFunction(60,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_23_label" role="button" hidefocus="true" tabindex="-1" title="Insert Special Character" class="cke_button cke_button__specialchar cke_button_off " id="cke_23"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -1152px;" class="cke_button_icon cke_button__specialchar_icon">&nbsp;</span><span class="cke_button_label cke_button__specialchar_label" id="cke_23_label">Insert Special Character</span></a></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_24_label" class="cke_toolbar" id="cke_24"><span class="cke_voice_label" id="cke_24_label">Tools</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><a onclick="CKEDITOR.tools.callFunction(67,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(66,event);" onfocus="return CKEDITOR.tools.callFunction(65,event);" onkeydown="return CKEDITOR.tools.callFunction(64,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_25_label" role="button" hidefocus="true" tabindex="-1" title="Maximize" class="cke_button cke_button__maximize cke_button_off " id="cke_25"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -896px;" class="cke_button_icon cke_button__maximize_icon">&nbsp;</span><span class="cke_button_label cke_button__maximize_label" id="cke_25_label">Maximize</span></a></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_26_label" class="cke_toolbar" id="cke_26"><span class="cke_voice_label" id="cke_26_label">Document</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><a onclick="CKEDITOR.tools.callFunction(71,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(70,event);" onfocus="return CKEDITOR.tools.callFunction(69,event);" onkeydown="return CKEDITOR.tools.callFunction(68,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_27_label" role="button" hidefocus="true" tabindex="-1" title="Source" class="cke_button cke_button__source cke_button_off " id="cke_27"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -1120px;" class="cke_button_icon cke_button__source_icon">&nbsp;</span><span class="cke_button_label cke_button__source_label" id="cke_27_label">Source</span></a></span><span class="cke_toolbar_end"></span></span><span class="cke_toolbar_break"></span><span role="toolbar" aria-labelledby="cke_28_label" class="cke_toolbar" id="cke_28"><span class="cke_voice_label" id="cke_28_label">Basic Styles</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><a onclick="CKEDITOR.tools.callFunction(75,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(74,event);" onfocus="return CKEDITOR.tools.callFunction(73,event);" onkeydown="return CKEDITOR.tools.callFunction(72,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_29_label" role="button" hidefocus="true" tabindex="-1" title="Bold" class="cke_button cke_button__bold cke_button_off " id="cke_29"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -32px;" class="cke_button_icon cke_button__bold_icon">&nbsp;</span><span class="cke_button_label cke_button__bold_label" id="cke_29_label">Bold</span></a><a onclick="CKEDITOR.tools.callFunction(79,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(78,event);" onfocus="return CKEDITOR.tools.callFunction(77,event);" onkeydown="return CKEDITOR.tools.callFunction(76,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_30_label" role="button" hidefocus="true" tabindex="-1" title="Italic" class="cke_button cke_button__italic cke_button_off " id="cke_30"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -64px;" class="cke_button_icon cke_button__italic_icon">&nbsp;</span><span class="cke_button_label cke_button__italic_label" id="cke_30_label">Italic</span></a><a onclick="CKEDITOR.tools.callFunction(83,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(82,event);" onfocus="return CKEDITOR.tools.callFunction(81,event);" onkeydown="return CKEDITOR.tools.callFunction(80,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_31_label" role="button" hidefocus="true" tabindex="-1" title="Strike Through" class="cke_button cke_button__strike cke_button_off " id="cke_31"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -96px;" class="cke_button_icon cke_button__strike_icon">&nbsp;</span><span class="cke_button_label cke_button__strike_label" id="cke_31_label">Strike Through</span></a><span role="separator" class="cke_toolbar_separator"></span><a onclick="CKEDITOR.tools.callFunction(87,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(86,event);" onfocus="return CKEDITOR.tools.callFunction(85,event);" onkeydown="return CKEDITOR.tools.callFunction(84,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_32_label" role="button" hidefocus="true" tabindex="-1" title="Remove Format" class="cke_button cke_button__removeformat cke_button_off " id="cke_32"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -1056px;" class="cke_button_icon cke_button__removeformat_icon">&nbsp;</span><span class="cke_button_label cke_button__removeformat_label" id="cke_32_label">Remove Format</span></a></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_33_label" class="cke_toolbar" id="cke_33"><span class="cke_voice_label" id="cke_33_label">Paragraph</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><a onclick="CKEDITOR.tools.callFunction(91,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(90,event);" onfocus="return CKEDITOR.tools.callFunction(89,event);" onkeydown="return CKEDITOR.tools.callFunction(88,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_34_label" role="button" hidefocus="true" tabindex="-1" title="Insert/Remove Numbered List" class="cke_button cke_button__numberedlist cke_button_off " id="cke_34"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -544px;" class="cke_button_icon cke_button__numberedlist_icon">&nbsp;</span><span class="cke_button_label cke_button__numberedlist_label" id="cke_34_label">Insert/Remove Numbered List</span></a><a onclick="CKEDITOR.tools.callFunction(95,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(94,event);" onfocus="return CKEDITOR.tools.callFunction(93,event);" onkeydown="return CKEDITOR.tools.callFunction(92,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_35_label" role="button" hidefocus="true" tabindex="-1" title="Insert/Remove Bulleted List" class="cke_button cke_button__bulletedlist cke_button_off " id="cke_35"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -480px;" class="cke_button_icon cke_button__bulletedlist_icon">&nbsp;</span><span class="cke_button_label cke_button__bulletedlist_label" id="cke_35_label">Insert/Remove Bulleted List</span></a><span role="separator" class="cke_toolbar_separator"></span><a onclick="CKEDITOR.tools.callFunction(99,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(98,event);" onfocus="return CKEDITOR.tools.callFunction(97,event);" onkeydown="return CKEDITOR.tools.callFunction(96,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_36_label" role="button" hidefocus="true" tabindex="-1" title="Decrease Indent" class="cke_button cke_button__outdent cke_button_disabled" id="cke_36" aria-disabled="true"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -672px;" class="cke_button_icon cke_button__outdent_icon">&nbsp;</span><span class="cke_button_label cke_button__outdent_label" id="cke_36_label">Decrease Indent</span></a><a onclick="CKEDITOR.tools.callFunction(103,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(102,event);" onfocus="return CKEDITOR.tools.callFunction(101,event);" onkeydown="return CKEDITOR.tools.callFunction(100,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_37_label" role="button" hidefocus="true" tabindex="-1" title="Increase Indent" class="cke_button cke_button__indent cke_button_off " id="cke_37"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -608px;" class="cke_button_icon cke_button__indent_icon">&nbsp;</span><span class="cke_button_label cke_button__indent_label" id="cke_37_label">Increase Indent</span></a><span role="separator" class="cke_toolbar_separator"></span><a onclick="CKEDITOR.tools.callFunction(107,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(106,event);" onfocus="return CKEDITOR.tools.callFunction(105,event);" onkeydown="return CKEDITOR.tools.callFunction(104,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_38_label" role="button" hidefocus="true" tabindex="-1" title="Block Quote" class="cke_button cke_button__blockquote cke_button_off " id="cke_38"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 -224px;" class="cke_button_icon cke_button__blockquote_icon">&nbsp;</span><span class="cke_button_label cke_button__blockquote_label" id="cke_38_label">Block Quote</span></a></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_40_label" class="cke_toolbar" id="cke_40"><span class="cke_voice_label" id="cke_40_label">Styles</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_combo cke_combo__styles  cke_combo_off" id="cke_39"><span class="cke_combo_label" id="cke_39_label">Styles</span><a onclick="CKEDITOR.tools.callFunction(108,this);return false;" onfocus="return CKEDITOR.tools.callFunction(110,event);" onmousedown="return CKEDITOR.tools.callFunction(111,event);" onkeydown="return CKEDITOR.tools.callFunction(109,event,this);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="true" aria-labelledby="cke_39_label" role="button" tabindex="-1" title="Formatting Styles" hidefocus="true" class="cke_combo_button"><span class="cke_combo_text cke_combo_inlinelabel" id="cke_39_text">Styles</span><span class="cke_combo_open"><span class="cke_combo_arrow"></span></span></a></span><span role="presentation" class="cke_combo cke_combo__format  cke_combo_off" id="cke_41"><span class="cke_combo_label" id="cke_41_label">Format</span><a onclick="CKEDITOR.tools.callFunction(112,this);return false;" onfocus="return CKEDITOR.tools.callFunction(114,event);" onmousedown="return CKEDITOR.tools.callFunction(115,event);" onkeydown="return CKEDITOR.tools.callFunction(113,event,this);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="true" aria-labelledby="cke_41_label" role="button" tabindex="-1" title="Paragraph Format" hidefocus="true" class="cke_combo_button"><span class="cke_combo_text cke_combo_inlinelabel" id="cke_41_text">Format</span><span class="cke_combo_open"><span class="cke_combo_arrow"></span></span></a></span><span class="cke_toolbar_end"></span></span><span role="toolbar" aria-labelledby="cke_42_label" class="cke_toolbar" id="cke_42"><span class="cke_voice_label" id="cke_42_label">about</span><span class="cke_toolbar_start"></span><span role="presentation" class="cke_toolgroup"><a onclick="CKEDITOR.tools.callFunction(119,this);return false;" onmousedown="return CKEDITOR.tools.callFunction(118,event);" onfocus="return CKEDITOR.tools.callFunction(117,event);" onkeydown="return CKEDITOR.tools.callFunction(116,event);" onblur="this.style.cssText = this.style.cssText;" aria-haspopup="false" aria-labelledby="cke_43_label" role="button" hidefocus="true" tabindex="-1" title="About CKEditor" class="cke_button cke_button__about cke_button_off " id="cke_43"><span style="background-image:url(http://localhost:49267/laravel/public/packages/noweb/cp/asset/resources/assets/ckeditor/plugins/icons.png?t=D08E);background-position:0 0px;" class="cke_button_icon cke_button__about_icon">&nbsp;</span><span class="cke_button_label cke_button__about_label" id="cke_43_label">About CKEditor</span></a></span><span class="cke_toolbar_end"></span></span></span></span><div role="presentation" class="cke_contents cke_reset" id="cke_1_contents" style="height: 200px;"><span class="cke_voice_label" id="cke_49">Press ALT 0 for help</span><iframe frameborder="0" style="width: 100%; height: 100%;" class="cke_wysiwyg_frame cke_reset" aria-describedby="cke_49" title="Rich Text Editor,editor1" src="" tabindex="0" allowtransparency="true"></iframe></div><span role="presentation" class="cke_bottom cke_reset_all" id="cke_1_bottom" style="-moz-user-select: none;"><span onmousedown="CKEDITOR.tools.callFunction(0, event)" title="Resize" class="cke_resizer cke_resizer_vertical cke_resizer_ltr" id="cke_1_resizer">◢</span><span class="cke_voice_label" id="cke_1_path_label">Elements path</span><span aria-labelledby="cke_1_path_label" role="group" class="cke_path" id="cke_1_path"><a aria-label="body element" role="button" onclick="CKEDITOR.tools.callFunction(1,1); return false;" onkeydown="return CKEDITOR.tools.callFunction(2,1, event );" hidefocus="true" onblur="this.style.cssText = this.style.cssText;" title="body element" class="cke_path_item" tabindex="-1" href="javascript:void('body')" id="cke_elementspath_3_1">body</a><a aria-label="p element" role="button" onclick="CKEDITOR.tools.callFunction(1,0); return false;" onkeydown="return CKEDITOR.tools.callFunction(2,0, event );" hidefocus="true" onblur="this.style.cssText = this.style.cssText;" title="p element" class="cke_path_item" tabindex="-1" href="javascript:void('p')" id="cke_elementspath_3_0">p</a><span class="cke_path_empty">&nbsp;</span></span></span></div></div>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </section>
                          </div>
                      </div>

                  </div>
              </div>
              <!-- page end-->
          </section>
<!--script for this page only-->
  <script type="text/javascript" src="{{$resources_path}}/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="{{$resources_path}}/js/news.js"></script>
<!-- END JAVASCRIPTS -->
