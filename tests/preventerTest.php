<?php
/**
 * @package midgardmvc_helper_xsspreventer
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */

/**
 * Test that
 *
 * @package midgardmvc_helper_xsspreventer
 */
class midgardmvc_helper_xsspreventer_tests_preventerTest extends midgardmvc_core_tests_testcase
{
    /**
      * Testing XML attribute escaping. Case tested is
      * "something "escape" more text" should be escaped and returned
      * "something &quot;escape&quot; more text
      */
            
    public function test_escape_attribute()
    {
        $testinput = 'some content that is "escaped" right';
        $testoutput = midgardmvc_helper_xsspreventer_helper::escape_attribute($testinput);
        $testoutput = substr($testoutput, 1,-1);
        $quote_present = strstr('"', $testoutput);
        $this->assertTrue( !$quote_present);
    }
    
    public function test_escape_element()
    {
        $teststring = "function(){} </script> testing testing";
        $output = midgardmvc_helper_xsspreventer_helper::escape_element('script', $teststring);
        $this->assertTrue(! strstr("</script>", $output));

    }
    
    public function test_escape_element_spacefirst()
    {
        $teststring = "function(){} < /script> testing testing";
        $output = midgardmvc_helper_xsspreventer_helper::escape_element('script', $teststring);
        $this->assertTrue(! strstr("< /script>", $output));
    }

    public function test_escape_element_spacefirst_after_slash()
    {
        $teststring = "function(){} </ script> testing testing";
        $output = midgardmvc_helper_xsspreventer_helper::escape_element('script', $teststring);
        $this->assertTrue(! strstr("</ script>", $output));
    }
    
    public function test_escape_element_space_before_and_after_slash()
    {
        $teststring = "function(){} < / script> testing testing";
        $output = midgardmvc_helper_xsspreventer_helper::escape_element('script', $teststring);
        $this->assertTrue(! strstr("< / script>", $output));
    }
    
    public function test_escape_element_space_after_tag()
    {
        $teststring = "function(){} </script > testing testing";
        $output = midgardmvc_helper_xsspreventer_helper::escape_element('script', $teststring);
        $this->assertTrue(! strstr("</script >", $output));
    }

    public function test_escape_element_space_beginning_and_after_tag()
    {
        $teststring = "function(){} < /script > testing testing";
        $output = midgardmvc_helper_xsspreventer_helper::escape_element('script', $teststring);
        $this->assertTrue(! strstr("< /script >", $output));
    }
    
    public function test_escape_element_space_beginning_and_after_slash_and_after_tag()
    {
        $teststring = "function(){} < / script > testing testing";
        $output = midgardmvc_helper_xsspreventer_helper::escape_element('script', $teststring);
        $this->assertTrue(! strstr("< / script >", $output));
    }

}

?>
