<!DOCTYPE html><html><head><meta charset="utf-8"></head><body id="preview">
<h1 class="code-line" data-line-start=0 data-line-end=1><a id="NovaIoT_Cookbook_0"></a>NovaIoT Cookbook</h1>
<p class="has-line-data" data-line-start="3" data-line-end="4"><img src="https://travis-ci.org/joemccann/dillinger.svg?branch=master" alt="Build Status"></p>
<p class="has-line-data" data-line-start="5" data-line-end="6">NovaIoT is an open-source framework that is made for spreading LoRa Sensors all over the world. NovaIoT package consists of two main parts:</p>
<ul>
<li class="has-line-data" data-line-start="6" data-line-end="7">The Hardware design for LoRa modules</li>
<li class="has-line-data" data-line-start="7" data-line-end="8">The Software design for LoRa sensors.</li>
<li class="has-line-data" data-line-start="8" data-line-end="10">And a little bit Magic :)</li>
</ul>
<h1 class="code-line" data-line-start=10 data-line-end=11><a id="New_Features_10"></a>New Features!</h1>
<ul>

<img src="https://raw.githubusercontent.com/cyses/Nova-IOT/master/Nova%20IOT%20Hardware/Images/3d.png" alt="Build Status">
<li class="has-line-data" data-line-start="12" data-line-end="13">You can visualize the sensor data in the GUI app with a RestFull API.</li>
</ul>
<p class="has-line-data" data-line-start="16" data-line-end="17">You can also:</p>
<ul>
<li class="has-line-data" data-line-start="17" data-line-end="18">Use the hardware design and print the PCB.</li>
<li class="has-line-data" data-line-start="18" data-line-end="19">With required components for PCB you can complete the sensor at all.</li>
<li class="has-line-data" data-line-start="19" data-line-end="20">You can use any IP67 case for the sensor. (We are going to upload the IP67 design soon if you want to use a ready one!)</li>
<li class="has-line-data" data-line-start="20" data-line-end="21">You can integrate the sensor on our server software. (which would be online soon!)</li>
<li class="has-line-data" data-line-start="21" data-line-end="22">You can use our GUI in order to visualize the sensor data (just think like mqtt)</li>
</ul>
<p class="has-line-data" data-line-start="24" data-line-end="25">Here there are several things that we need to mention before we start!</p>
<blockquote>
<p class="has-line-data" data-line-start="26" data-line-end="32">Our primer aim is to spread this LoRa sensors all over the world fastly.<br>
We really believe in the power of open-source<br>
and we are always open to commits and suggestions!<br>
Please feel free if you have an idea for making any of these technologies better<br>
We are ready to hear and make the system better!<br>
or if you just want to use the design, you are very welcome. But do not forget that, it is free for NON-COMMERCIAL use!</p>
</blockquote>
<h3 class="code-line" data-line-start=34 data-line-end=35><a id="Tech_34"></a>Tech</h3>
<p class="has-line-data" data-line-start="36" data-line-end="37">First lets mention what components should you use. The components in the lists required very hard work and took a lot of time in order to find them.</p>
<ul>
<li class="has-line-data" data-line-start="38" data-line-end="39">STM32L072CZT6 - The main microprocessor that we used in our PCB</li>
<li class="has-line-data" data-line-start="39" data-line-end="40">SX1276IMLTRT - the core component for LoRa</li>
<li class="has-line-data" data-line-start="40" data-line-end="41">Li/SOCL2 4000 mAH 3.6v connector 2.54mm Two batteries side by side with protection - this is the magic battery. :)</li>
<li class="has-line-data" data-line-start="41" data-line-end="42">RFM95W-868 - the integrated LoRa module</li>
</ul>
<h3 class="code-line" data-line-start=45 data-line-end=46><a id="Installation_45"></a>Installation</h3>
<p class="has-line-data" data-line-start="47" data-line-end="49">We are changing our software infrastructure in docker based containers. But of course that would take time. Until that time you can use our PHP applications for GUI and server. You can ask us anything if you tackle in somewhere.<br>
The requirements for now are;</p>
<ul>
<li class="has-line-data" data-line-start="50" data-line-end="51">PHP 7.2 +</li>
<li class="has-line-data" data-line-start="51" data-line-end="52">Apache</li>
<li class="has-line-data" data-line-start="52" data-line-end="53">MySQL</li>
</ul>
After completing the setup of docker infrastructure, you would be run the environment as
<pre><code class="has-line-data" data-line-start="56" data-line-end="60" class="language-sh">$ <span class="hljs-built_in">docker</span> compose up

</code></pre>
<h3 class="code-line" data-line-start=63 data-line-end=64><a id="Todos_63"></a>Todos</h3>
<ul>
<li class="has-line-data" data-line-start="65" data-line-end="66"><em>Docker container</em></li>
<li class="has-line-data" data-line-start="66" data-line-end="68">Improvements in hardware design in order to make the PCB smaller</li>
</ul>
<h2 class="code-line" data-line-start=68 data-line-end=70><a id="License_68"></a>License</h2>
<p class="has-line-data" data-line-start="71" data-line-end="72">MIT</p>
<p class="has-line-data" data-line-start="74" data-line-end="75"><strong>Free Software, Hell Yeah!</strong></p>
</body></html>
